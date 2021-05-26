<template>

    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <h3>{{currentDate.date}}</h3>
                <span>{{currentDate.day}}</span>
            </div>
        </div>
        <a role="button" class="carousel-control-prev"  @click="(triggerSwipeDay(currentDate.date, -1))">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a role="button" class="carousel-control-next" @click="triggerSwipeDay(currentDate.date, 1)">
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

                var formattedcurrentDate = this.formatDMY(currentDate);
                var formattedMaxDate = this.formatDMY(moment(this.maxDate).format("MMM D, YYYY"));
                var formattedMinDate = this.formatDMY(this.minDate);

                if (formattedcurrentDate <= formattedMinDate && direction == -1) {
                    this.$bvToast.show('min-toast');
                }else if(formattedcurrentDate >= formattedMaxDate && direction == 1)
                {
                    this.$bvToast.show('max-toast');
                }else{
                    this.$emit("triggerSwipeDay", currentDate, direction);
                }             
            },

            formatDMY(date)
            {
                return moment(date).format('x'); 
            },
        }

    }
</script>