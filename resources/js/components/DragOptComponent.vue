<template>
    <div>
        <div class="div_opt">
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
                        <div
                            class="elm"
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
        <v-app id="inspire">
            <div class="text-center">
                <v-dialog v-model="dialog" width="400">
                    <v-card>
                        <v-card-title class="headline">Segura ?</v-card-title>
                        <v-card-text>
                            <b>Vuelve a intentarlo! </b>  <br>
                            Let Google help apps determine
                            location. This means sending anonymous location data
                            to Google, even when no apps are
                            running.</v-card-text
                        >
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="green darken-1"
                                text
                                @click="dialog = false"
                                >OK</v-btn
                            >
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
        this.opt = JSON.parse(this.operations);
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

    data() {
        return {
            opt: this.opt,
            list1: [],
            resul: [],
            value1: 0,
            value2: 0,
            response_user: 0,
            dialog: false,
            colors_numbers: [
                "#DF3A01",
                "#5FB404",
                "#FFBF00",
                "#045FB4",
                "#FF8000"
            ]
        };
    },

    created: function() {},

    methods: {
        speakResponse: function() {
            console.log("speakResponse ");
            this.speak("Muy bien !");
            this.speak(" ");

            const text = `${this.value1} + ${this.value2} = ${(this.value1 + this.value2)}`;
            this.speak(text);
            /* this.speak(this.value1);
            this.speak("+");
            this.speak(this.value2);
            this.speak("= a");
            this.speak(this.value1 + this.value2);

            Cuando inicia (Start) a decir cada palabra se aumenta el tamaño del numero
            cuando termina (End) vuelve al original
            */
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
                    return false;
                } else {
                    console.log("Respuesta correcta !");
                    this.speakResponse();
                }
            }
        },

        checkMove(evt) {}
    }
};
/*
TODO:
pendiente
* voces sync con numeros
* Estilos Dialog
* Respuesta correcta nueva operacion
* Intentos
* Vidas en cero, envío evento a firebase
*/
</script>


<style scoped>
.div_opt {
    border: 3px solid #df01a5;
    border-radius: 20px;
    background-color: #f2f2f2;
    width: 80%;
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
    font-size: 61px;
    font-family: "Mystery Quest", cursive;
    color: #8904b1;
    font-weight: bold;
    cursor: move;
    border: none;
    font-weight: bold;
}
.list-group {
    display: inline !important;
}
</style>
