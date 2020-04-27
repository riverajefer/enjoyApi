<template>
    <div class="principal">
        <div
            class="div_opt"
            :style="{
                backgroundImage: `url(/images/${back_images[level - 1]})`
            }"
        >
            <div class="row">
                <div class="col-1 col-sm-1 offset-md-3">
                    <draggable
                        class="dragArea val val1"
                        id="vail1"
                        :list="opt"
                        group="people"
                        @change="log"
                        :disabled="true"
                    >
                        <div
                            class="elm"
                            v-for="element in opt"
                            :key="element.val1"
                        >
                            {{ element.val1 }}
                        </div>
                    </draggable>
                </div>
                <div class="col-1">
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
                        <div
                            class="elm"
                            transition="scale-transition"
                            v-for="element in opt"
                            :key="element.name"
                        >
                            {{ element.val2 }}
                        </div>
                    </draggable>
                </div>
                <div class="col-1">
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
                        @change="log"
                    >
                        <div
                            class="elm"
                            v-for="element in resul"
                            :key="element"
                        >
                            {{ element }}
                        </div>
                    </draggable>
                </div>
            </div>
            <v-divider></v-divider>
            <div class="row">
                <div class="col-9 offset-md-2">
                    <draggable
                        :move="checkMove"
                        class="dragArea list-group"
                        :list="list1"
                        :group="{ name: 'people', pull: 'clone', put: false }"
                        @change="log"
                        @end="onEnd"
                    >
                        <v-chip
                            class="ma-2 numbers_opt"
                            outlined
                            v-for="(element, i) in list1"
                            :key="element"
                            :style="{ color: colors_numbers[i] }"
                        >
                            {{ element }}
                        </v-chip>
                    </draggable>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <v-alert dense text>
                    <span class="ml-10 lives_title">VIDAS</span>
                    <span v-for="item in lives"> ❤️ </span>
                </v-alert>
            </div>
            <div class="col-6">
                <v-alert dense text>
                    <span class="ml-10 lives_title">NIVEL {{ level }} </span>
                </v-alert>
            </div>
        </div>
        <v-progress-linear
            v-model="progress"
            height="15"
            color="#D7DF01"
            background-color="#F5F6CE"
            rounded
            striped
        >
            <strong>{{ Math.ceil(progress) }}%</strong>
        </v-progress-linear>
        <v-alert
            :value="alert"
            color="#088A4B"
            height="37"
            transition="scale-transition"
        >
            <p class="alert_ok">
                👍 MUY BIEN !
            </p>
        </v-alert>
        <v-app id="inspire">
            <div class="text-center">
                <v-dialog v-model="dialog" width="300">
                    <v-card color="#385F73" dark center>
                        <v-card-title class="red lighten-1 mb-10"
                            >ERROR !</v-card-title
                        >
                        <v-card-text class="text-center">
                            <img
                                :src="'/images/face_error.png'"
                                :alt="'face_error'"
                                width="170px"
                            />
                            <br />
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="white darken-1"
                                text
                                @click="dialog = false"
                                >VOLVER A INTENTAR!
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </div>
        </v-app>
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
        const opt = JSON.parse(this.operations);
        this.newOpt(opt);
    },

    data() {
        return {
            progress: 0,
            quantity_opt: 2,
            count_opt_response: 0,
            opt: this.opt,
            list1: [],
            resul: [],
            value1: 0,
            value2: 0,
            level: 1,
            levels: ["easy", "medium", "hard"],
            lives: [1, 2, 3, 4, 5],
            alert: false,
            response_user: 0,
            dialog: false,
            colors_numbers: [
                "#DF3A01",
                "#5FB404",
                "#FFBF00",
                "#045FB4",
                "#FF8000"
            ],
            back_images: ["fondo1.jpg", "fondo2.jpg", "fondo3.jpg"]
        };
    },

    created: function() {},

    methods: {
        newOpt: function(operation) {
            this.opt = operation;
            let arr = [];
            this.value1 = this.opt[0].val1;
            this.value2 = this.opt[0].val2;
            const result = this.value1 + this.value2;

            while (arr.length < 5) {
                var r = Math.floor(Math.random() * 20) + 1;
                if (arr.indexOf(r) === -1) arr.push(r);
            }
            this.list1 = arr;

            this.list1.indexOf(result) === -1
                ? (this.list1.pop(), this.list1.push(result))
                : console.log("This item already exists");
            this.list1.sort(() => Math.random() - 0.5);
        },

        speakResponse: function() {
            console.log("speakResponse ");
            this.speak("Muy bien !");
            this.speak(" ");

            const text = `${this.value1} + ${this.value2} = ${this.value1 +
                this.value2}`;
            this.speak(text);
        },
        speak: function(msg) {
            var _msg = new SpeechSynthesisUtterance(msg);
            _msg.rate = 1;
            window.speechSynthesis.speak(_msg);
            _msg.onpause = function() {
                console.log("pause de hablar");
            };
            _msg.onend = function() {
                console.log("termino de hablar");
            };
        },

        onEnd: function(evt) {},
        log: function(evt) {
            window.console.log(evt);

            if (evt.added !== undefined) {
                this.response_user = evt.added.element;
                const resp_correct = this.value1 + this.value2;

                if (this.response_user !== resp_correct) {
                    this.resul.pop();
                    this.dialog = true;
                    this.lives.pop();
                    return false;
                } else {
                    console.log("Respuesta correcta !");
                    this.alert = true;
                    this.speakResponse();
                    this.count_opt_response++;
                    this.progress =
                        (this.count_opt_response * 100) / this.quantity_opt;

                    setTimeout(() => {
                        if (this.progress >= 100) {
                            this.level++;
                            this.progress = 0;
                            this.count_opt_response = 0;
                        }

                        this.getNewOpt();
                    }, 4500);
                }
            }
        },

        getNewOpt: function() {
            let body = { level: this.levels[this.level - 1] };
            axios.post("new_opt", body).then(response => {
                console.log(response.data);
                this.alert = false;
                this.resul = [];
                this.newOpt(response.data);
            });
        },

        checkMove(evt) {}
    }
};
/*
TODO:
pendiente
* Vidas
* Vidas en cero, envío evento a firebase
* Cuando complete los 3 nivles  Ganador!

*/
</script>

<style scoped>
.theme--light.v-application {
    background: none !important;
}
.principal {
    width: 80%;
    margin: 0 auto;
}
.div_opt {
    background-image: url("/images/fondo1.jpg");
    border: 3px solid #aeb404;
    background-size: 100%;
    border-radius: 20px;
    margin: 0 auto;
    padding: 30px;
}
.val {
    height: 100px;
    text-align: center;
}
.list-group-item {
    background-color: transparent;
    display: block;
}
.div_resul {
    border: 2px dashed #ff0080;
    width: 110px;
    border-radius: 20px;
}

.elm {
    text-align: center;
    font-size: 70px;
    font-weight: bold;
    margin: 0;
    padding-top: 0px;
    font-family: "Mystery Quest", cursive;
    color: #8904b1;
    text-shadow: 2px 2px 0 #bcbcbc, 4px 4px 0 #9c9c9c;
}
.plus {
    font-size: 80px;
    color: #b4045f;
}
.numbers_opt {
    text-align: center;
    margin: 5px 15px;
    width: 80px;
    height: 80px;
    font-size: 70px;
    font-family: "Mystery Quest", cursive;
    color: #8904b1;
    text-shadow: 2px 2px 0 #bcbcbc, 4px 4px 0 #9c9c9c;
    font-weight: bold;
    cursor: move;
    border: none;
    font-weight: bold;
}
.list-group {
    display: inline !important;
}
.alert_ok {
    color: #f2f2f2;
    font-weight: bold;
    font-size: 10px;
    padding: 0px 0px;
}
.lives_title {
    color: #f2f2f2;
    font-weight: bold;
    padding-right: 15px;
    padding-left: 0px;
}
</style>
