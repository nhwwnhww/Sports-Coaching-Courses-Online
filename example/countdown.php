<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <link rel="stylesheet" href="./countdown.scss">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>

    <script>
        var SpeechRecognition = SpeechRecognition || window.webkitSpeechRecognition || undefined;
var numbers = Array.apply(null, Array(101)).map(function (_, i) {return i;});

if(SpeechRecognition) {
  var SpeechGrammarList = SpeechGrammarList || window.webkitSpeechGrammarList || undefined;
  var SpeechRecognitionEvent = SpeechRecognitionEvent || window.webkitSpeechRecognitionEvent || undefined;
  
  var commands = ['reset', 'timer', ...numbers];
  var grammar = '#JSGF V1.0; grammar colors; public <color> = ' + commands.join(' | ') + ' ;'

  var speechRecognitionList = new SpeechGrammarList();
      speechRecognitionList.addFromString(grammar, 1);
      
  var recognition = new SpeechRecognition();
      recognition.grammars = speechRecognitionList;
      //recognition.continuous = false;
      recognition.lang = 'en-US';
      recognition.interimResults = true;
      recognition.maxAlternatives = 1;
}

var speechSynth = new SpeechSynthesisUtterance();

const padDigits = (number, digits) => {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}

const calculatePercentsLeft = (value, from) => {
    return Math.floor(Math.ceil(value/1000) / (from * 60) * 100)
}

const calculateScaleFactor = (percent) => {
    return 1-(100-percent)/100;
}

function guid() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
    s4() + '-' + s4() + s4() + s4();
}

const settings = {
  water: {
    warningMsg: 'Remember to drink',
    timeIsUpMsg: 'Time\'s up. You really need to drink now',
    buttonTxt: 'Drink',
    waveFrontColor: '#32BAFA',
    waveBackColor: '#2C7FBE',
    stageBg: '#1E384C',
    durationInMinutes: 1
  },
  coffee: {
    warningMsg: `It's almost coffee time.`,
    timeIsUpMsg: 'Time\'s up. Let\'s take a coffee break!',
    buttonTxt: 'Drink coffee',
    waveFrontColor: '#b39374',
    waveBackColor: '#7a6057',
    stageBg: '#392a2c',
    durationInMinutes: 1
  },
  break: {
    warningMsg: 'It is time to rest your eyes soon!',
    timeIsUpMsg: 'Time\'s up. Now, it\'s really time to rest your eyes!',
    buttonTxt: 'Take a break',
    waveFrontColor: '#02C39A',
    waveBackColor: '#028090',
    stageBg: '#012F35',
    durationInMinutes: 1
  },
  beer: {
    warningMsg: `I know this sounds scary, but it's almost time for another beer`,
    timeIsUpMsg: `It's been a while since the last beer!`,
    buttonTxt: 'Have a beer',
    waveFrontColor: '#F1B10F',
    waveBackColor: '#FFFFFF',
    stageBg: '#5A3900',
    durationInMinutes: 60
  }
};

new Vue({
  el: '#stage',
  data() {
    return {
        color: '',
        percents: [100],
        percentsLeft: 100,
        secondsLeft: 0,
        waveStyles: '',
        duration: 1,
        timer: [],
        voicesOpen: false,
        voices: [],
        selectedVoice: {},
        countdownObj: {},
        activeReminder: settings.water,
        menuOpen: false,
        isListening: false,
        tooltipText: 'Say eg. "reset"',
        stageBg: settings.water.stageBg
    }
  },
  mounted() {
    this.resetTimer();
    this.voices = speechSynthesis.getVoices();

    if(this.voices.length === 0) {
      speechSynthesis.onvoiceschanged = () => {
        this.voices = speechSynthesis.getVoices();
      };
    }
  },
  computed: {
    supportSpeechSynth() {
      return 'speechSynthesis' in window; 
    },
    supportSpeechRecognition() {
      return SpeechRecognition;
    }
  },
  watch: {
    percentsLeft: function(val, oldVal) {
      if (val === oldVal) {
        return;
      }
      this.percents.splice(0, 1);
      this.percents.push(val);
    }
  },
  methods: {
    setActiveReminder(reminder) {
      this.activeReminder = settings[reminder];
      this.stageBg = this.activeReminder.stageBg;
    },
    toggleMenu() {
      this.menuOpen = !this.menuOpen;
      if(this.menuOpen) {
        this.pauseTimer();
        this.waveStyles = `transform: translate3d(0,100%,0); transition-delay: .25s;`;
      }else {
        this.continueTimer();
      }
    },
    toggleVoicesMenu() {
      this.voicesOpen = !this.voicesOpen;
    },
    voiceSelected(voice) {
      this.selectedVoice = voice;
      speechSynth.voice = voice;
    },
    start(reminder) {
      this.setActiveReminder(reminder);
      this.percents = [100];
      this.timer = [];
      this.menuOpen = false;
      this.resetTimer();
    },
    resetTimer() {
      let durationInSeconds = 60 * this.activeReminder.durationInMinutes;
      this.startTimer(durationInSeconds);
    },
    startTimer(secondsLeft) {
      let now = new Date();

      // later on, this timer may be stopped
      if(this.countdown) {
        window.clearInterval(this.countdown);
      }
      
      this.countdown = countdown(ts => {
        this.secondsLeft= Math.ceil(ts.value/1000);
        this.percentsLeft = calculatePercentsLeft(ts.value,this.activeReminder.durationInMinutes);
        this.waveStyles = `transform: scale(1,${calculateScaleFactor(this.percentsLeft)})`;
        this.updateCountdown(ts);
        if(this.percentsLeft == 10) {
          this.giveWarning();
        }
        if(this.percentsLeft <= 0){
          this.timeIsUpMessage();
          this.pauseTimer();
          this.timer = [];
          setTimeout(() => {
            this.startListenVoiceCommands();
          }, 1500);
          
        }
      }, now.getTime() + (secondsLeft * 1000));
    },
    updateCountdown(ts) {
      if(this.timer.length > 2) {
        this.timer.splice(2);
      }

      const newTime = {
        id: guid(),
        value: `${padDigits(ts.minutes, 2)}:${padDigits(ts.seconds, 2)}`
      };

      this.timer.unshift(newTime);
    },
    pauseTimer() {
      window.clearInterval(this.countdown);
    },
    continueTimer() {
      if(this.secondsLeft > 0) {
        this.startTimer(this.secondsLeft-1);
      }
    },
    giveWarning() {
      speechSynth.text = this.activeReminder.warningMsg;
      window.speechSynthesis.speak(speechSynth);
    },
    timeIsUpMessage() {
      speechSynth.text = this.activeReminder.timeIsUpMsg;
      window.speechSynthesis.speak(speechSynth);
    },
    timerResetMessage() {
      speechSynth.text = `Timer reset. Time left ${this.activeReminder.durationInMinutes} ${this.activeReminder.durationInMinutes > 1 ? 'minutes': 'minute'}`;
      window.speechSynthesis.speak(speechSynth);
    },
    reset() {
      this.resetTimer();
      this.timerResetMessage();
    },
    startListenVoiceCommands() {
      if(this.isListening || !this.supportSpeechRecognition) return;

      this.isListening = true;
      recognition.start();
      recognition.onresult = (event) => {
        let last = event.results.length - 1;
        let transcript = event.results[last][0].transcript;
        let splittedTranscript = transcript.split(' ');
        let isFinal = event.results[last].isFinal;

        this.tooltipText = transcript;

        if(transcript == "reset") {
          this.resetTimer();
          this.timerResetMessage();
        }
        if(
          splittedTranscript.length >= 3 &&
          splittedTranscript[0] == 'timer' &&
          isFinal &&
          numbers.includes(Number(splittedTranscript[1])) && 
          (splittedTranscript[2] == 'minute' || splittedTranscript[2] == 'minutes')
        ) {
          this.activeReminder.durationInMinutes = numbers[splittedTranscript[1]];
          this.resetTimer();
          this.timerResetMessage();
        }
        

      }
      recognition.onend = () => {
        this.isListening = false;
        this.tooltipText == '';
        recognition.stop();
      }
      recognition.onsoundend = () => {
        this.isListening = false;
        recognition.stop();
      }
    },
    mouseOver(type) {
      this.stageBg = settings[type].stageBg;
    },
    mouseOut() {
      this.stageBg = this.activeReminder.stageBg;
    }
  }
});

    </script>
</head>
<body>
<div id="stage" class="stage" :class="{'menu-open': menuOpen, 'voices-open': voicesOpen}" :style="{ color: activeReminder.waveFrontColor, backgroundColor: stageBg }" v-cloak>
  <div class="menu__button" @click="toggleMenu">
    <div class="menu__dot"></div>
  </div>
  <div class="microphone" v-if="supportSpeechRecognition" :class="{'is-listening': isListening }" @click="startListenVoiceCommands">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 16c2.206 0 4-1.795 4-4v-6c0-2.206-1.794-4-4-4s-4 1.794-4 4v6c0 2.205 1.794 4 4 4z"></path>
                <path d="M19 12v-2c0-0.552-0.447-1-1-1s-1 0.448-1 1v2c0 2.757-2.243 5-5 5s-5-2.243-5-5v-2c0-0.552-0.447-1-1-1s-1 0.448-1 1v2c0 3.52 2.613 6.432 6 6.92v1.080h-3c-0.553 0-1 0.447-1 1s0.447 1 1 1h8c0.553 0 1-0.447 1-1s-0.447-1-1-1h-3v-1.080c3.387-0.488 6-3.4 6-6.92z"></path>
            </svg>
    <div class="voice-tooltip" v-show="isListening">
                <transition name="fade" mode="out-in">
                    <span :key="tooltipText">{{ tooltipText }}</span>
                </transition>
            </div>
  </div>
  <div class="voices-menu">
    <svg class="voices-menu__bg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><title>sphere</title><circle cx="25" cy="25" r="25"/></svg>
    <div class="voices-menu__button" @click="toggleVoicesMenu">
      <svg xmlns="http://www.w3.org/2000/svg" width="768" height="768" viewBox="0 0 768 768">
                    <path d="M523.5 448.5h108c4.5-21 9-42 9-64.5s-4.5-43.5-9-64.5h-108c3 21 4.5 42 4.5 64.5s-1.5 43.5-4.5 64.5zM466.5 625.5c58.5-19.5 109.5-61.5 139.5-114h-94.5c-10.5 40.5-25.5 78-45 114zM459 448.5c3-21 4.5-42 4.5-64.5s-1.5-43.5-4.5-64.5h-150c-3 21-4.5 42-4.5 64.5s1.5 43.5 4.5 64.5h150zM384 639c27-39 48-81 61.5-127.5h-123c13.5 46.5 34.5 88.5 61.5 127.5zM256.5 256.5c10.5-40.5 25.5-78 45-114-58.5 19.5-109.5 61.5-139.5 114h94.5zM162 511.5c30 52.5 81 94.5 139.5 114-19.5-36-34.5-73.5-45-114h-94.5zM136.5 448.5h108c-3-21-4.5-42-4.5-64.5s1.5-43.5 4.5-64.5h-108c-4.5 21-9 42-9 64.5s4.5 43.5 9 64.5zM384 129c-27 39-48 81-61.5 127.5h123c-13.5-46.5-34.5-88.5-61.5-127.5zM606 256.5c-30-52.5-81-94.5-139.5-114 19.5 36 34.5 73.5 45 114h94.5zM384 64.5c177 0 319.5 142.5 319.5 319.5s-142.5 319.5-319.5 319.5-319.5-142.5-319.5-319.5 142.5-319.5 319.5-319.5z"></path>
                </svg>
      <span>Select voice</span>
    </div>
    <div class="voices-menu__close" @click="toggleVoicesMenu">
      <svg xmlns="http://www.w3.org/2000/svg" width="768" height="768" viewBox="0 0 768 768">
                    <path d="M607.5 205.5l-178.5 178.5 178.5 178.5-45 45-178.5-178.5-178.5 178.5-45-45 178.5-178.5-178.5-178.5 45-45 178.5 178.5 178.5-178.5z"></path>
                </svg>
    </div>
    <div class="voices-list-wrapper">
      <ul class="voices-list">
        <li class="voices-list__item" :class="{'is-selected': selectedVoice.name === voice.name }" v-for="voice in voices" :key="voice.lang">
          <a href="#" class="voices-list__link" @click.prevent="voiceSelected(voice)">
            <span class="voices-list__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="768" height="768" viewBox="0 0 768 768">
                                    <path d="M672 160q13.75 0 22.875 9.125t9.125 22.875q0 13.5-9.25 22.75l-384 384q-9.25 9.25-22.75 9.25t-22.75-9.25l-192-192q-9.25-9.25-9.25-22.75 0-13.75 9.125-22.875t22.875-9.125q13.5 0 22.75 9.25l169.25 169.5 361.25-361.5q9.25-9.25 22.75-9.25z"></path>
                                </svg>
                            </span>
            <div class="voices-list__content">
              <div>{{voice.name}}</div>
              <span>{{voice.lang}}</span>
              <span v-if="voice.default" class="voices-list__default">Default</span>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="menu">
    <ul class="menu__list">
      <li class="menu__item" @mouseover="mouseOver('water')" @mouseout="mouseOut()" @touchstart="mouseOver('water')" @touchend="mouseOut()">
        <a href="#" @click.prevent="start('water')">
          <svg id="coffee-cup" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                            <title>coffee-cup-01</title>
                            <path class="water-glass" d="M39.92,45H25V43.21H38.15L43.14,4l2,.2ZM25,45H10.08L4.89,4.15l2-.2,5,39.26H25Z"/>
                            <path class="water-glass__water" d="M39.09,6.88s-3.13,2-5.48,0c-4.92,2.65-7.72,0-7.72,0s-4.59,2.76-7.94,0c-4.47,3.09-7,0-7,0l3.91,33.76H35Z"/>
                        </svg>
          <span>Water break</span>
        </a>
      </li>
      <li class="menu__item" @mouseover="mouseOver('coffee')" @mouseout="mouseOut()" @touchstart="mouseOver('coffee')" @touchend="mouseOut()">
        <a href="#" @click.prevent="start('coffee')">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                            <title>coffee-cup</title>
                            <path class="coffee-cup" d="M49.42,21.07a9.69,9.69,0,0,0-2.17-6.55,10.16,10.16,0,0,0-7.08-3.12c-.14-2.47-.38-4-.38-4H36.58S42,39.54,20.43,39.56C-1.87,39.57,4.16,7.37,4.16,7.37H1.07S-4.29,43,20.43,43c9.31,0,14.35-5.06,17-11.37C40.47,31.4,49.43,29.84,49.42,21.07Zm-11,7.82a49,49,0,0,0,1.81-14.83,8.13,8.13,0,0,1,5.52,2.4,6.76,6.76,0,0,1,1.49,4.63C47.29,26.71,41.58,28.39,38.45,28.89Z"/>
                            <path class="coffee-cup__coffee" d="M7.07,11.94H33.73s3.72,23.65-13.3,23.65S7.07,11.94,7.07,11.94Z"/>
                        </svg>
          <span>Coffee break</span>
        </a>
      </li>
      <li class="menu__item" @mouseover="mouseOver('break')" @mouseout="mouseOut()" @touchstart="mouseOver('break')" @touchend="mouseOut()">
        <a href="#" @click.prevent="start('break')">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                            <title>clock</title>
                            <path class="clock" d="M24.62,47.08A21.88,21.88,0,1,1,46.49,25.21,21.9,21.9,0,0,1,24.62,47.08Zm0-41.75A19.88,19.88,0,1,0,44.49,25.21,19.9,19.9,0,0,0,24.62,5.33Z"/>
                            <path class="clock__short" d="M34.49,26.71H24.62a1.5,1.5,0,0,1,0-3h9.88a1.5,1.5,0,0,1,0,3Z"/>
                            <path class="clock__long" d="M24.62,26.71a1.5,1.5,0,0,1-1.5-1.5V9.54a1.5,1.5,0,0,1,3,0V25.21A1.5,1.5,0,0,1,24.62,26.71Z"/>
                        </svg>
          <span>Office Break</span>
        </a>
      </li>
      <li class="menu__item" @mouseover="mouseOver('beer')" @mouseout="mouseOut()" @touchstart="mouseOver('beer')" @touchend="mouseOut()">
        <a href="#" @click.prevent="start('beer')">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
            <title>beer</title>
            <path class="beer-glass" d="M45.92,15.71c-1.63-1.88-6.55-1.15-9.2-.58-.15-2.82-.25-5.46-.26-7.76h-2c0,3.69.27,8.17.55,12.92.48,8.19,1.21,20.56-.59,21.86-3.17,2.29-29,2.49-31,.23C2,40.7,2.45,23.3,3.69,7.45l-1-.08-1-.08C1.08,15.1-.69,40.8,1.95,43.72c1.39,1.54,8.15,2.19,15.27,2.19,8,0,16.56-.83,18.38-2.14,1.3-.94,1.84-3.56,2-7.66,2-.05,6.17-.29,8.09-1.36.78-.44,1.3-1.49,1.62-3.32C48,27.21,47.61,17.67,45.92,15.71Zm-.4,13.59c-.27,3.16-.85,3.7-.84,3.7-1.4.78-5,1-7.1,1.11,0-3.71-.25-8.38-.58-13.93q-.09-1.53-.17-3c3.26-.71,6.88-.93,7.58-.13S46,24.13,45.52,29.3Z"/>
<path class="beer-glass__beer" d="M5.9,12.92s-2.57,25.8,0,27.71,24.3,1,26.59,0S32,12.92,32,12.92Z"/>
          </svg>
          <span>Beer Break</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="browser-support" v-if="!supportSpeechSynth">
    Your browser doesn't <strong>support</strong> speech synthesis.
  </div>
  <div class="time">
    <transition-group name="timer" tag="div">
      <div v-for="time in timer" class="timer__item" :key="time.id">
        {{ time.value }}
      </div>
    </transition-group>
  </div>
  <div class="waves" :style="waveStyles">
    <div class="wave wave--back" :style="{ color: activeReminder.waveBackColor }">
      <div class="water">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 350 32" preserveAspectRatio="none"><title>wave2</title><path d="M350,17.32V32H0V17.32C116.56,65.94,175-39.51,350,17.32Z"/></svg>
      </div>
      <div class="water">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 350 32" preserveAspectRatio="none"><title>wave2</title><path d="M350,17.32V32H0V17.32C116.56,65.94,175-39.51,350,17.32Z"/></svg>
      </div>
    </div>
    <div class="wave wave--front" :style="{ color: activeReminder.waveFrontColor }">
      <div class="water">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 350 32" preserveAspectRatio="none"><title>wave2</title><path d="M350,17.32V32H0V17.32C116.56,65.94,175-39.51,350,17.32Z"/></svg>
      </div>
      <div class="water">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 350 32" preserveAspectRatio="none"><title>wave2</title><path d="M350,17.32V32H0V17.32C116.56,65.94,175-39.51,350,17.32Z"/></svg>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="percent">
      <transition name="percent-left" mode="out-in">
        <div :key="percentsLeft">{{ percentsLeft }}</div>
      </transition>
      <span>%</span>
    </div>
  </div>
  <button @click="reset">
            {{ percentsLeft > 0 ? activeReminder.buttonTxt : 'Reset' }}
        </button>
</div>
</body>
</html>