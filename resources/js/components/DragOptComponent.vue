<template>
  <div class="row">
    <div class="col-3">
      <h3>Lista</h3>
      <draggable
        :move="checkMove"
        class="dragArea list-group"
        :list="list1"
        :group="{ name: 'people', pull: 'clone', put: false }"
        @change="log"
        @end="onEnd"
      >
        <div class="list-group-item" v-for="element in list1" :key="element">{{ element }}</div>
      </draggable>
    </div>

    <div class="col-2">
      <h3>Val1</h3>
      <draggable class="dragArea val val1" id="vail1" :list="opt" group="people" @change="log">
        <div class="list-group-item" v-for="element in opt" :key="element.val1">{{ element.val1 }}</div>
      </draggable>
    </div>

    <div class="col-2">
      <h3>Val2</h3>
      <draggable class="dragArea val" id="vail2" :list="opt" group="people" @change="log">
        <div class="list-group-item" v-for="element in opt" :key="element.name">{{ element.val2 }}</div>
      </draggable>
    </div>

    <div class="col-2">
      <h3>Resul</h3>
      <draggable
        class="dragArea val resul"
        id="resul"
        :list="resul"
        group="people"
        @added="onAdd()"
        @change="log"
      >
        <div class="list-group-item" v-for="element in resul" :key="element">{{ element }}</div>
      </draggable>
    </div>
    <!-- <p>{{operations}}</p> -->
    <p>{{ list1 }}</p>
    <p>resul: {{ resul }}</p>
  </div>
</template>

<script>
import draggable from "vuedraggable";

export default {
  props: ["operations"],
  order: 2,
  components: {
    draggable
  },
  mounted() {
    this.opt = JSON.parse(this.operations);
    var arr = [];
    while (arr.length < 8) {
      var r = Math.floor(Math.random() * 20) + 1;
      if (arr.indexOf(r) === -1) arr.push(r);
    }
    this.list1 = arr;
  },

  data() {
    return {
      opt: this.opt,
      list1: [],
      resul: [],
      respuesta: 0
    };
  },
  computed: {},
  created() {},

  methods: {
    onAdd: function(evt) {
      console.log("evt_add", evt);
    },

    add: function() {
      console.log("Add");

      this.list.push({ name: "Juan" });
    },
    onEnd: function(evt) {
      console.log("onEnd", evt);

      const area_id = evt.to["id"]; // get id area
      console.log("area_id: ", evt.to["id"]);
      console.log("val1: ", this.opt[0].val1);
      console.log("val2: ", this.opt[0].val2);
      const value = Number(evt.to["textContent"]);
      console.log("value_resul: ", value);
      console.log("this.respuesta: ", this.respuesta);

      const resp = this.opt[0].val1 + this.opt[0].val2;
      console.log("resp ", resp);

      if (this.respuesta !== resp) {
        this.resul.pop();
        return false;
      }
    },
    replace: function() {
      this.list = [{ name: "Edgard" }];
    },
    clone: function(el) {
      return {
        name: el.name + " cloned"
      };
    },
    log: function(evt) {
      window.console.log(evt);
      console.log("evt.aadded", evt.added.element);
      this.respuesta = evt.added.element;
    },

    checkMove(evt) {}
  }
};
</script>
<style scoped>
.val {
  margin: 5px;
  padding: 15px;
  min-width: 100px;
  min-height: 100px;
  border: 1px dotted gray;
  border-radius: 20px;
}
.list-group-item {
  background-color: transparent;
}
</style>
