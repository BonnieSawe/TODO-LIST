<template>
    <div>
        <div class="carousel slide" data-ride="carousel">
            <div class="carousel-inner text-center">
                <div class="carousel-item active">
                    <h3>{{formattedStartDate + ' - ' + formattedEndDate}}</h3>
                    <span>{{startDateDay + ' - ' + endDateDay}}</span>
                </div>
            </div>
            <a v-if="!disablePrev" role="button" class="carousel-control-prev" @click="triggerSwipeWeek(endDate, -1)">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a v-if="!disableNext" role="button" class="carousel-control-next" @click="triggerSwipeWeek(endDate, 1) ">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>

        <AddTask :data="null" :minDate="startDate" :maxDate="endDate" :weekSelected="true" @newTodoItem="addTodoItem"></AddTask>
    </div>
</template>
<script>

    import store from "@/store";
    import moment from 'moment';

    export default {
        name: 'WeekCarousel',
        data() {
            return {
                formattedStartDate:null,
                formattedEndDate:null,
                startDate: null,
                startDateDay: null,
                endDate: null,
                endDateDay: null,
            }
        },

        props: ["data"],
        
        mounted() {
            this.formatDate(Date.now());
            this.formattedStartDate = moment(this.startDate).format("DD/M/YY");
            this.formattedEndDate = moment(this.endDate).format("DD/M/YY");
        },
        
        computed: {
            maxDate() {
                return moment(Date.now()).format("MMM D, YYYY");
            },

            minDate() {
                return moment(store.getters["auth/user"].created_at).format("MMM D, YYYY");
            },

            disablePrev()
            {
                if (moment(moment(this.startDate).format("MMM D, YYYY")).isSameOrBefore(moment(this.minDate))) return true
                return false
            },

            disableNext()
            {
                if (moment(moment(this.endDate).format("MMM D, YYYY")).isSameOrAfter(moment(this.maxDate))) return true
                return false
            }
        },
        methods: {
            triggerSwipeWeek(date, direction) {
                this.formatDate(
                    moment(date).add(direction, 'weeks')
                )             
            },

            formatDMY(date)
            {
                return moment(date).format("DD-MM-YYYY"); 
            },

            formatDate(timestamp)
            {
                this.endDate = moment(timestamp).format("MMM D, YYYY");
                this.endDateDay = moment(timestamp).format("dddd");
                this.startDate = moment(timestamp).subtract(6, 'days').format("MMM D, YYYY");
                this.startDateDay = moment(timestamp).subtract(6, 'days').format("dddd");


                if (moment(this.startDate).isBefore(moment(this.minDate))) {
                    this.startDate = this.minDate;
                }

                if(moment(this.endDate).isAfter(moment(this.maxDate)))
                {
                    this.endDate = this.maxDate;
                }

                this.formattedStartDate = moment(this.startDate).format("DD/M/YY");
                this.formattedEndDate = moment(this.endDate).format("DD/M/YY");

                this.$emit("triggerSwipeWeek", this.startDate,this.endDate);
            },

            addTodoItem(item)
            {
                this.$emit('newTodoItem', item);
            }
        }
    }
</script>