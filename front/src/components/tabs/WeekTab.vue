<template>

    <b-tab class="tab1" title="Week">

        <CarouselView></CarouselView>

        <AddTask></AddTask>

        <DayTask></DayTask>

    </b-tab>
</template>
<script>


export default {
    name: 'WeekTab',
    props: {},
    data() {
        return {
            posts: [],
            services: [
                { name: "Catering", img: "vendor.jpg" },
                { name: "Photography", img: "service.jpg" },
                { name: "Weddings", img: "person.jpg" },
            ],
            currentSlide: 0,
            maxSlide: null,
            currItem: {},
        }
    },
    mounted() {
        this.currItem = this.services[this.currentSlide]
        this.maxSlide = this.services.length - 1;
    },
    methods: {
        updateSwipe(index) {
            this.currentSlide = index;
            this.currItem = this.services[index];
        },  

    }

}
</script>