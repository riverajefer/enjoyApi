<template>
    <div class="row">
        <div class="col-1">
            <draggable
                class="dragArea val val1"
                id="vail1"
                :list="opt"
                group="people"
                @change="log"
                :disabled="true"
            >
                <div class="elm" v-for="element in opt" :key="element.val1">
                    {{ element.val1 }}
                </div>
            </draggable>
        </div>
        <div class="col-1">
            <!-- <img :src="'/images/plus.png'" :alt="'Plus'" width="70px" /> -->
            <div class="elm plus">
                +
            </div>
        </div>

        <div class="col-1">
            <draggable
                class="dragArea val"
                id="vail2"
                :list="opt"
                group="people"
                @change="log"
                :disabled="true"
            >
                <div class="elm" v-for="element in opt" :key="element.name">
                    {{ element.val2 }}
                </div>
            </draggable>
        </div>
        <div class="col-1">
            <!-- <img :src="'/images/equal.png'" :alt="'Equal'" width="70px" /> -->
            <div class="elm plus">
                =
            </div>
        </div>
        <div class="col-2">
            <draggable
                class="dragArea val div_resul"
                id="resul"
                :list="resul"
                group="people"
                @added="onAdd()"
                @change="log"
            >
                <div class="elm" v-for="element in resul" :key="element">
                    {{ element }}
                </div>
            </draggable>
        </div>

        <div class="col-6">
            <draggable
                :move="checkMove"
                class="dragArea list-group"
                :list="list1"
                :group="{ name: 'people', pull: 'clone', put: false }"
                @change="log"
                @end="onEnd"
            >
                <div
                    class="list-group-item"
                    v-for="element in list1"
                    :key="element"
                >
                    {{ element }}
                </div>
            </draggable>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";
// it :smile😂 💪

export default {
    props: ["operations"],
    name: "DragOpt",
    order: 2,
    components: {
        draggable
    },
    mounted() {
        this.opt = JSON.parse(this.operations);
        let arr = [];
        while (arr.length < 5) {
            var r = Math.floor(Math.random() * 20) + 1;
            if (arr.indexOf(r) === -1) arr.push(r);
        }
        this.list1 = arr;
        console.log("val1 :", this.opt[0].val1);

        const val1 = this.opt[0].val1;
        const val2 = this.opt[0].val2;
        const result = val1 + val2;

        this.list1.indexOf(result) === -1
            ? (this.list1.pop(), this.list1.push(result))
            : console.log("This item already exists");
        this.list1.sort(() => Math.random() - 0.5);
    },

    data() {
        return {
            opt: this.opt,
            list1: [],
            resul: [],
            response_user: 0
        };
    },

    methods: {
        onAdd: function(evt) {
            console.log("evt_add", evt);
        },

        onEnd: function(evt) {
            console.log("onEnd", evt);
            const area_id = evt.to["id"]; // get id area

            console.log("val1: ", this.opt[0].val1);
            console.log("val2: ", this.opt[0].val2);
            console.log("this.respuesta: ", this.response_user);

            const resp = this.opt[0].val1 + this.opt[0].val2;
            console.log("resp ", resp);

            if (this.response_user !== resp) {
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
            this.response_user = evt.added.element;
        },

        checkMove(evt) {}
    }
};
</script>
<style scoped>
.val {
    width: 100px;
    min-width: 100px;
    height: 100px;
    /* border: 1px solid gray; */
    border-radius: 20px;
    text-align: center;
}
.list-group-item {
    background-color: transparent;
}
.div_resul {
    border: 2px dashed gray !important;
}

.elm {
    text-align: center;
    font-size: 70px;
    font-weight: bold;
    margin: 0;
    padding-top: 0px;
    font-family: "Mystery Quest", cursive;
    color: #8904b1;
}
.plus {
    font-size: 80px;
    color: #b4045f;
}
</style>
