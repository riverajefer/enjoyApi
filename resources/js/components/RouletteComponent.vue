<template>
    <v-app>
        <div class="text-center">
            <div class="change mb-10">
                <img
                    :src="`/images/roulette/${item_current.image}`"
                    :alt="'face'"
                    width="170px"
                />
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
                    image: "coin.png",
                    name: "tres",
                    id: 3
                },
                {
                    image: "chomp.png",
                    name: "Cuatro",
                    id: 4
                },
                {
                    image: "coin.png",
                    name: "Cinco",
                    id: 5
                },
                {
                    image: "coin.png",
                    name: "Seis",
                    id: 6
                }
            ],
            item_current: Object
        };
    },
    created() {
        this.item_current = this.items[0];
    },
    methods: {
        onStartRoulette: function() {
            console.log("items: ", this.items);

            const randomItem = this.items[
                Math.floor(Math.random() * this.items.length)
            ];
            console.log("start Roulette: ", randomItem);
        }
    }
};
</script>

<style>
.theme--light.v-application {
    background: none !important;
}
</style>
