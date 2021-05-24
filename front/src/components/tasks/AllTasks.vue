<template>
    <div v-if="todoItems.length">
        <div class="" v-for="todoItem in todoItems" :key="todoItem.id">
            <SingleTask 
                :data="todoItem"
                @deleteItem="deleteItem"
                @triggerAddMemo="triggerAddMemo"
            >
            </SingleTask>
        </div>

        <b-modal ref="add-memo-modal" centered hide-footer hide-header title="Add Memo" ::passedObject="todoItemId" class="text-center">
            <h3 class="add-memo-title pt-2 pb-2">ADD A MEMO</h3>
            <form @submit.prevent="saveMemo">
                <b-form-input
                    :state="null"
                    placeholder="Add a task..."
                    class="memo-input"
                    type="text"
                    v-model="form.name"
                    required
                />
                <b-button class="btn-sm submit-memo mt-3 mr-2 col-md-3" type="submit"><span class="btn-text">Add Memo</span></b-button>
                <b-button class="btn-sm cancel-memo mt-3 mr-2 col-md-3" @click="hideModal"><span class="btn-text">Cancel</span></b-button>
            </form>
        </b-modal>

    </div>
    <div v-else>
        <NoItems></NoItems>
    </div>
</template>
<script>

import Todo from '@/services/todo'

export default {
    name: 'AllTasks',
    data() {
        return {
            form: {},
            todoItemId: null,
            error: null,
            success: null,
        }
    },
    props: ["data"],
    computed: {
        todoItems() {
            return this.data ? this.data : {};
        },
        
    },

    methods: {
        deleteItem(todoItemId)
        {
            this.todoItems.splice(this.todoItems.indexOf(todoItemId), 1);
        },

        triggerAddMemo(todoItemId) {
            this.todoItemId = todoItemId;
            this.$refs["add-memo-modal"].show();
        },

        hideModal() {
            this.$refs['add-memo-modal'].hide()
        },


        async saveMemo()
        {
            this.form.todo_item_id = this.todoItemId;
            console.log(this.form);
            const { created, success, message } = await Todo.addMemo(this.form);
            if (success) {
                this.form = {}
                this.success = message
                this.$refs['add-memo-modal'].hide()
                this.$emit('newMemoAdded', created)

            } else {
                this.error = message;
            }
        }
    }
}
</script>

<style lang="scss">
    .modal-dialog{
        width: 362px !important;
        height: 189px !important;
        
        .modal-content{
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.16);
            background-color: #3c424a;

        }

        .add-memo-title{
            color: #ccd7e2;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.28px;
            text-transform: uppercase;
        }

        .memo-input{
            width: 314px;
            height: 65px;
            border-radius: 5px;
            border: 2px solid #2e3238;
            background-color: #343a40;
        }

        .submit-memo{
            width: 90px;
            height: 42px;
            border-radius: 5px;
            background-color: #e55c8a;
            color:#ccd7e2;
        }

        .cancel-memo{
            width: 90px;
            height: 42px;
            border-radius: 5px;
            background-color: #6f757e;
            color:#ccd7e2;
        }

        .btn-text{
            color: #ccd7e2;
            font-size: 12px;
            font-weight: 600;
        }
    }
</style>
