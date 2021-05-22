<template>

    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <h3>{{currItem.name}}</h3>
                <span>Mar 23, 2021</span>
            </div>
        </div>
        <a role="button" :class="currentSlide === 0 ? 'carousel-control-prev disable-btn' : 'carousel-control-prev'"  @click="currentSlide === 0 ?  '' : updateSwipe(currentSlide-1) ">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a role="button" :class="currentSlide === maxSlide ? 'carousel-control-next  disable-btn' : 'carousel-control-next '" @click="currentSlide === maxSlide ?  '' : updateSwipe(currentSlide+1) ">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
</template>
<script>


export default {
    name: 'CarouselView',
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