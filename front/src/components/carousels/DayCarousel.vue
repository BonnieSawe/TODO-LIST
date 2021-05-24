<template>

    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <h3>{{currentDate.date}}</h3>
                <span>{{currentDate.day}}</span>
            </div>
        </div>
        <a role="button" class="carousel-control-prev"  @click="triggerSwipeDay(currentDate.date, -1)">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a role="button" class="carousel-control-next" @click="triggerSwipeDay(currentDate.date, 1)">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
</template>
<script>


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
        
    },
    methods: {
        triggerSwipeDay(currentDate, direction) {
            this.$emit("triggerSwipeDay", currentDate, direction);
        },


    }

}
</script>