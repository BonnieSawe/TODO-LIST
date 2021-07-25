<template>

    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <h3>{{currentDate.date}}</h3>
                <span>{{currentDate.day}}</span>
            </div>
        </div>
        <a v-if="!disablePrev" role="button" class="carousel-control-prev"  @click="(triggerSwipeDay(currentDate.date, -1))">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a v-if="!disableNext" role="button" class="carousel-control-next" @click="triggerSwipeDay(currentDate.date, 1)">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
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

            formattedcurrentDate() {
                return this.formatDMY(this.currentDate.date)
            },

            disablePrev()
            {
                var formattedMinDate = this.formatDMY(this.minDate);
                if (this.formattedcurrentDate <= formattedMinDate) return true
                return false
            },

            disableNext()
            {
                var formattedMaxDate = this.formatDMY(moment(this.maxDate).format("MMM D, YYYY"));
                if (this.formattedcurrentDate >= formattedMaxDate) return true
                return false
            }
        },
        methods: {
            triggerSwipeDay(currentDate, direction) {           
                this.$emit("triggerSwipeDay", currentDate, direction);
            },

            formatDMY(date)
            {
                return moment(date).format('x'); 
            },
        }

    }
</script>