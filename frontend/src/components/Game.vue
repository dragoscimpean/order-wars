<template>
<div>
  <div class="d-flex justify-content-around">
    <b-card
        title="Card Title"
        img-src="https://picsum.photos/600/300/?image=25"
        img-alt="Image"
        img-top
        tag="article"
        style="max-width: 20rem;"
        class="mb-2"
    >
      <b-card-text>
        Some quick example text to build on the card title and make up the bulk of the card's content.
      </b-card-text>

      <b-button href="#" variant="primary">Go somewhere</b-button>
    </b-card>
    <div>
      <img alt="Vue logo" class="logo" :class="{ moveTop: started }" src="../assets/logo.png">
      <div v-if="started"><h1>Round {{ round }}</h1></div>
    </div>
    <b-card
        title="Card Title"
        img-src="https://picsum.photos/600/300/?image=25"
        img-alt="Image"
        img-top
        tag="article"
        style="max-width: 20rem;"
        class="mb-2"
    >
      <b-card-text>
        Some quick example text to build on the card title and make up the bulk of the card's content.
      </b-card-text>

      <b-button href="#" variant="primary">Go somewhere</b-button>
    </b-card>
  </div>

  <div class="hello">
    <div class="startButton" v-if="!started" @click="start()">
      Start
    </div>
    <div v-else>

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
      attacker: {

      },
      leftCharacter: {

      },
      rightCharacter: {

      }
    }
  },
  methods: {
    start() {
      this.started = !this.started;
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
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
