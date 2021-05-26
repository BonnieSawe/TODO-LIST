<template>
    <div>
        <b-toast :id="'successToast'+weekSelected" variant="warning" solid>
            <template #toast-title>
                <b-img blank blank-color="#ff9b99" class="mr-2" width="12" height="12"></b-img>
                <div class="d-flex flex-grow-1 align-items-baseline">
                    <strong class="mr-auto">Task added successfully, cheers!</strong>
                </div>
            </template>
        </b-toast>

        <b-toast :id="'errorToast'+weekSelected" variant="warning" solid>
            <template #toast-title>
                <b-img blank blank-color="#ff9b99" class="mr-2" width="12" height="12"></b-img>
                <div class="d-flex flex-grow-1 align-items-baseline">
                    <strong class="mr-auto">There was an error adding task, try again later.</strong>
                </div>
            </template>
        </b-toast>

        <div class="mt-5 pt-3 form-input">
            <span class="pt-3"><i class="fa fa-list" aria-hidden="true"></i></span>
            <b-form-input
            :state="null"
            placeholder="Add a task..."
            class="form-control"
            type="text"
            v-model="form.name"
            required
            @keyup.enter="addTask"
            />
        </div>

        <b-modal v-if="weekSelected" ref="choose-date-modal" centered hide-footer hide-header title="Add Memo">
            <h3 class="choose-date-title text-white text-center pt-2 pb-2">Choose Date</h3>
            <div class="mb-2 text-center">
                <b-calendar :min="minFDate" :max="maxFDate" id="datepicker" v-model="form.date" @context="onContext" class="mb-2 calenda"></b-calendar>
                <button @click="addTask" class="btn btn-primary text-white mt-2" type="submit">Proceed</button>
            </div>
        </b-modal>
    </div>
</template>
<script>
import Todo from '@/services/todo';
export default {
    name: 'AddTask',
    data() {
        return {
            form: {},
            error: null,
            success: null,
            responseMessage: null,
            context: null,
            value: null

        }
    },

    props: ["data", "weekSelected", "minDate", "maxDate"],
    computed: {
        currDate() {
            return this.data ? this.data : null;
        }, 
        
        minFDate() {
            return new Date(this.minDate);
        }, 
        
        maxFDate() {
            return new Date(this.maxDate);
        } 
    },

    mounted() {
        // console.log(this.props)
        // this.minFDate = new Date(this.minDate);
        // this.maxFDate = new Date(this.maxDate);
    },

    methods: {

        onContext(ctx) {
            this.context = ctx
        },

        async addTask()
        {
            if (this.weekSelected && !this.form.date) {
                this.$refs["choose-date-modal"].show();
                return false;
            }

            if (this.weekSelected) {
                this.$refs["choose-date-modal"].hide();
            }else{
                this.form.date = this.currDate;
            }

            this.error = null;

            const { created, success, message, errors } = await Todo.store(this.form);

            this.responseMessage = message+' '+errors;

            if (success) {

                this.$bvToast.show('successToast'+this.weekSelected)

                this.form = {}
                this.context = null;
                this.$emit('newTodoItem', created);

            } else {
                this.$bvToast.show('errorToast'+this.weekSelected)
            }
        }
    }
}
</script>

<style lang="scss">
    .calenda{
        .text-dark, #datepicker__calendar-grid-caption_, .b-calendar-grid-weekdays, .b-calendar-nav, .form-control-sm   {
            color:#ccd7e2 !important;
        }
    }
</style>