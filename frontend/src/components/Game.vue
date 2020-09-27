<template>
<div>
  <div class="d-flex justify-content-around">
    <b-card
        :title="player.name"
        img-src="../assets/alliance-banner.png"
        img-alt="Image"
        img-top
        tag="article"
        style="max-width: 20rem;"
        class="mb-2"
        v-show="player"
    >
      <b-progress :max="100" height="2rem" show-progress v-for="stat in getPlayerStats" :key="'player'+stat" class="mt-2">
        <b-progress-bar :value="player[stat]">
          <span>{{ stat }}: <strong>{{ player[stat] }} / 100</strong></span>
        </b-progress-bar>
      </b-progress>
    </b-card>
    <div>
      <img alt="Vue logo" class="logo" :class="{ moveTop: started }" src="../assets/logo.png">
      <div v-if="started"><h1>Round {{ round }}</h1></div>
    </div>

    <b-card
        :title="enemy.name"
        img-src="../assets/horde-banner.jpg"
        img-alt="Image"
        img-top
        tag="article"
        style="max-width: 20rem;"
        class="mb-2"
        v-show="enemy"
    >
      <b-progress :max="100" height="2rem" show-progress v-for="stat in getEnemyStats" :key="'enemy'+stat" class="mt-2">
        <b-progress-bar :value="enemy[stat]">
          <span>{{ stat }}: <strong>{{ enemy[stat] }} / 100</strong></span>
        </b-progress-bar>
      </b-progress>
    </b-card>
  </div>

  <div class="hello">
    <div class="startButton" v-if="!started" @click="start()">
      Start
    </div>
    <div v-else class="battleground">
      <img class="characters player" :src="getEntityAnimationUrl('player')" ref="player">
      <img class="characters enemy" :src="getEntityAnimationUrl('enemy')" ref="enemy">
    </div>
    <div>
      <button @click="attack('player')">Player Atk</button>
      <button @click="attack('enemy')">Enemy Atk</button>
    </div>
  </div>
</div>
</template>

<script>
export default {
  name: 'Game',
  data() {
    return {
      started: false,
      round: 1,
      attacker: {},
      player: false,
      enemy: false,
      playerAnimation: 'stand.png',
      enemyAnimation: 'stand.png',
    }
  },
  computed: {
    getPlayerStats() {
      return Object.keys(this.player).filter(property => {
        return Number.isInteger(this.player[property]);
      });
    },
    getEnemyStats() {
      return Object.keys(this.enemy).filter(property => {
        return Number.isInteger(this.enemy[property]);
      });
    },
  },
  methods: {
    async start() {
      this.started = !this.started;

      const response = await this.$http.get('http://order-wars.test/start');

      this.player = response.data.orderus;
      this.enemy = response.data.beast;
      this.attacker = response.data.attacker === 'Orderus' ? 'player' : 'enemy';
      console.log(this.attacker);
      this.attack(this.attacker);
      console.log('attacked');
    },
    getEntityAnimationUrl(entity) {
      return require('../assets/characters/'+entity+'/'+this[entity+'Animation'])
    },
    attack(attacker) {
      console.log(attacker + 'is attacking!');
      const attackerAnimation = attacker + 'Animation';
      this[attackerAnimation] = 'run.gif';
      this.$refs[attacker].classList.add(attacker+'Move');
      setTimeout(async () => {
        this[attackerAnimation] = 'attack.gif';


        const response = await this.$http({
          method: 'post',
          url: 'http://order-wars.test/attack',
          data: {
            player: this.player,
            enemy: this.enemy,
            attacker: this[attacker].name,
          }
        });

        this.player = response.data.player;
        this.enemy = response.data.enemy;
        this.attacker = response.data.attacker;

        const target = attacker === 'player' ? 'enemy' : 'player';
        if (this[target].health <= 0) {
          this.die(target);
        }

        setTimeout(() => {
          this[attackerAnimation] = 'run.gif';
          this.$refs[attacker].classList.remove(attacker+'Move');

          setTimeout(() => {
            this[attackerAnimation] = 'stand.png';
            this.round++;
          },2000)
        }, 1000)
      }, 2000);
    },
    die(entity) {
      const entityAnimation = entity + 'Animation';
      this[entityAnimation] = 'die.gif';
      setTimeout(() => {
        this[entityAnimation] = 'dead.png';
      }, 1000)
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>


.enemy {
  right: 30%;
}

.player {
  left:30%;
  z-index: 2;
}

.playerMove {
  left: 55%;
}

.enemyMove {
  right: 55%;
}

.characters {
  position:absolute;
  height:200px;
  transition: 2s left, 2s right;
}

.logo {
  border-radius: 29px;
  margin-top: 130px;
  transition: 0.3s;
}

.moveTop {
  margin-top: 0px;
}

.startButton {
  width: 300px;
  margin: 50px auto;
  padding: 30px 50px;
  background-color: #0082e6;
  color: white;
  font-size: 40px;
  border-radius: 10px;
}

h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
