<template>
    <v-app>
        <div class="text-center">
            <div class="change mb-10 mt-20">
                <img
                    :src="`/images/roulette/${item_current.image}`"
                    :alt="'face'"
                    width="170px"
                />
                <p class="mt-10 bold">{{ item_current.name }}</p>
            </div>
            <v-btn rounded color="primary" @click="onStartRoulette()" dark
                >START ROULETTE</v-btn
            >
        </div>
    </v-app>
</template>

<script>
import { db } from "../db";

export default {
    data() {
        return {
            items: [
                {
                    image: "chomp.png",
                    name: "Uno",
                    id: 1
                },
                {
                    image: "coin.png",
                    name: "Dos",
                    id: 2
                },
                {
                    image: "mshroom.png",
                    name: "tres",
                    id: 3
                },
                {
                    image: "pastel.jpg",
                    name: "cuatro",
                    id: 4
                },
                {
                    image: "pastel.jpg",
                    name: "cuatro",
                    id: 4
                },
                {
                    image: "random.png",
                    name: "Cinco",
                    id: 5
                },
                {
                    image: "flower.png",
                    name: "Seis",
                    id: 6
                },
                {
                    image: "star.png",
                    name: "Siete",
                    id: 7
                },
                {
                    image: "pastel.jpg",
                    name: "cuatro",
                    id: 4
                }
            ],
            item_current: Object
        };
    },
    created() {
        this.item_current = this.items[3];
    },
    methods: {
        onStartRoulette: function() {
            this.onChangeStatusFirebase(false);


            const randomItem = this.items[
                Math.floor(Math.random() * this.items.length)
            ];

            let time = 0;
            this.intervalid1 = setInterval(() => {
                time++;
                console.log("time: ", time);
                if (this.items.length == time) {
                    time = 0;
                } else {
                    this.item_current = this.items[time];
                }
            }, 100);

            setTimeout(() => {
                clearInterval(this.intervalid1);
                console.log("randomItem Roulette: ", randomItem);
                this.item_current = randomItem;
                if (this.item_current.id == 4) {
                    this.onChangeStatusFirebase(true);
                    setTimeout(() => {
                        console.log("Perdio y su pastelazo le pegó");
                        const audio = new Audio("/sounds/alarma.wav");
                        audio.play();
                    }, 1000);
                }
                const audio = new Audio("/sounds/bee.wav");
                audio.play();
            }, 2500);

            // set time out clear interval
            // time rand margen 7000 - 10000+


            this.item_current = randomItem;
        },
        onChangeStatusFirebase: function(val) {
            console.log("onChangeStatusFirebase");
            db.ref("app")
                .child("resul_status")
                .set(val);
        }
    }
};
</script>

<style>
.theme--light.v-application {
    background: none !important;
}
</style>
