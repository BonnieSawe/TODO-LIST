<template>
    <div>
        <b-alert v-if="success" class="mt-3" show variant="success">{{success}}</b-alert>
        <b-alert v-if="error" class="mt-3" show variant="danger">{{error}}</b-alert>
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
    </div>
</template>
<script>
import Todo from '@/services/todo';
export default {
    name: 'AddTask',
    props: {},
    data() {
        return {
            form: {},
            error: null,
            success: null,
        }
    },

    methods: {
        async addTask()
        {
            this.error = this.success = null;
            const { created, success, message } = await Todo.store(this.form);
            console.log(created, success)
            if (success) {
                this.success = message

            } else {
                this.error = message;
            }

        }
    }
}
</script>
