<template>

    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <h3>{{startDate + ' - ' + endDate}}</h3>
                <span>{{currentWeek.startDateDay + ' - ' + currentWeek.endDateDay}}</span>
            </div>
        </div>
        <a role="button" class="carousel-control-prev"  @click="triggerSwipeWeek(currentWeek.startDate, -1)">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a role="button" class="carousel-control-next" @click="triggerSwipeWeek(currentWeek.startDate, 1)">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
</template>
<script>

import moment from 'moment'
export default {
    name: 'WeekCarousel',
    data() {
        return {

        }
    },

    components: {
        moment
    },

    props: ["data"],
    computed: {
        currentWeek() {
            return this.data ? this.data : {};
        }, 
        startDate() {
            return this.data ? moment(this.data.startDate).format("DD/M/YY") : null;
        },
        endDate() {
            return this.data ? moment(this.data.endDate).format("DD/M/YY") : null;
        },          
    },
    methods: {
        triggerSwipeWeek(startDate, direction) {
            this.$emit("triggerSwipeWeek", startDate, direction);
        },
    }

}
</script>