<template>
    <div>
        <div class="carousel slide" data-ride="carousel">
            <div class="carousel-inner text-center">
                <div class="carousel-item active">
                    <h3>{{formattedStartDate + ' - ' + formattedEndDate}}</h3>
                    <span>{{startDateDay + ' - ' + endDateDay}}</span>
                </div>
            </div>
            <a role="button" class="carousel-control-prev" @click="triggerSwipeWeek(endDate, -1)">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a role="button" class="carousel-control-next" @click="triggerSwipeWeek(endDate, 1) ">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>

            <b-toast id="min-toast" variant="warning" solid>
                <template #toast-title>
                    <b-img blank blank-color="#ff9b99" class="mr-2" width="12" height="12"></b-img>
                    <div class="d-flex flex-grow-1 align-items-baseline">
                        <strong class="mr-auto">Min Date Reached</strong>
                    </div>
                </template>
            </b-toast>

            <b-toast id="max-toast" variant="warning" solid>
                <template #toast-title>
                    <b-img blank blank-color="#ff9b99" class="mr-2" width="12" height="12"></b-img>
                    <div class="d-flex flex-grow-1 align-items-baseline">
                        <strong class="mr-auto">Max Date Reached</strong>
                    </div>
                </template>
            </b-toast>
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
        },
        methods: {
            triggerSwipeWeek(date, direction) {
                

                var formattedStartDate = this.formatDMY(this.startDate);
                var formattedMinDate = this.formatDMY(this.minDate);

                if (moment(formattedStartDate).isSameOrBefore(formattedMinDate) && direction == -1) {
                    this.$bvToast.show('min-toast');
                }else if(moment(date).isSameOrAfter(moment(this.maxDate)) && direction == 1)
                {
                    this.$bvToast.show('max-toast');
                }else{
                    this.formatDate(
                        moment(date).add(direction, 'weeks')
                    )   
                }             
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