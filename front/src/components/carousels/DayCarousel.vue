<template>

    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <h3>{{currentDate.date}}</h3>
                <span>{{currentDate.day}}</span>
            </div>
        </div>
        <a role="button" class="carousel-control-prev"  @click="(minDate < currentDate.date) ? triggerSwipeDay(currentDate.date, -1) : $bvToast.show('minToast') ">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a role="button" class="carousel-control-next" @click="(maxDate > currentDate.date) ? triggerSwipeDay(currentDate.date, 1) : $bvToast.show('maxToast') ">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>

        <b-toast id="minToast" variant="warning" solid>
            <template #toast-title>
                <b-img blank blank-color="#ff9b99" class="mr-2" width="12" height="12"></b-img>
                <div class="d-flex flex-grow-1 align-items-baseline">
                    <strong class="mr-auto">Min Date Reached</strong>
                </div>
            </template>
        </b-toast>

        <b-toast id="maxToast" variant="warning" solid>
            <template #toast-title>
                <b-img blank blank-color="#ff9b99" class="mr-2" width="12" height="12"></b-img>
                <div class="d-flex flex-grow-1 align-items-baseline">
                    <strong class="mr-auto">Max Date Reached</strong>
                </div>
            </template>
        </b-toast>
    </div>
</template>
<script>

    import store from "@/store";
    import moment from 'moment'

    export default {
        name: 'DayCarousel',
        data() {
            return {

            }
        },

        props: ["data"],
        computed: {
            currentDate() {
                return this.data ? this.data : {};
            },

            maxDate() {
                return moment(Date.now()).format("MMM D, YYYY");
            },

            minDate() {
                return moment(store.getters["auth/user"].created_at).format("MMM D, YYYY");
            },
            
        },
        methods: {
            triggerSwipeDay(currentDate, direction) {
                this.$emit("triggerSwipeDay", currentDate, direction);
            },
        }

    }
</script>