<template>
    <div class="mb-3 row d-flex">

        <div class="float-left invisible">
            <i class="fa fa-thumb-tack pinned"></i>
        </div>

        <div class="custom-control custom-checkbox ">
            <b-form-checkbox
            :id="todoItem.main_key"
            v-model="todoItem.completed" @change="completeItem"
            >
            {{todoItem.name}}
            </b-form-checkbox>

            <!-- <input type="checkbox" class="custom-control-input" :id="todoItem.main_key" name="">
            <label class="custom-control-label" :for="todoItem.main_key">{{todoItem.name}}</label> -->

            <TaskMemo :data="todoItem.memo"></TaskMemo>
        </div>

        <!-- <AddMemo></AddMemo> -->

        <b-modal ref="add-memo-modal" centered hide-footer hide-header title="Add Memo" ::passedObject="todoItemId" class="text-center">
            <h3 class="add-memo-title pt-2 pb-2" v-if="!editable">ADD A MEMO</h3>
            <h3 class="add-memo-title pt-2 pb-2" v-else>Edit MEMO</h3>
            <form @submit.prevent="saveMemo">
                <b-form-input
                    :state="null"
                    placeholder="Add a task..."
                    class="memo-input"
                    type="text"
                    v-model="form.name"
                    required
                />
                <b-button class="btn-sm submit-memo mt-3 mr-2 col-md-3" v-if="!editable" type="submit">
                    <span class="btn-text" >Add Memo</span>
                </b-button>

                <b-button class="btn-sm submit-memo mt-3 mr-2 col-md-3"  v-else type="submit">
                    <span class="btn-text">Edit Memo</span>
                </b-button>

                <b-button class="btn-sm cancel-memo mt-3 mr-2 col-md-3" @click="hideModal"><span class="btn-text">Cancel</span></b-button>
            </form>
        </b-modal>


        <div class="ml-auto pl-5">
            <Actions 
                :data="todoItem" 
                @deleteItem="deleteItem" 
                @triggerAddMemo="triggerAddMemo"
            >

            </Actions>
        </div>
    </div>
</template>
<script>
    import Todo from '@/services/todo'
    export default {
        name: 'SingleTask',
        props: ["data", "uniqueKey"],
        data() {
            return {
                form: {},
                todoItemId: null,
                error: null,
                success: null,
                editable:false,
                checkedItem:{},
            }
        },
        computed: {
            todoItem() {
                this.checkedItem.isChecked = this.data.completed
                return this.data ? this.data : {};
            }, 
        },
        methods: {
            deleteItem(todoItemId)
            {
                this.$emit("deleteItem", this.main_key);
            },

            triggerAddMemo(editable) {
                this.editable = editable
                this.form.name = this.todoItem.name
                this.$refs["add-memo-modal"].show();
            },

            hideModal() {
                this.$refs['add-memo-modal'].hide()
            },

            async completeItem(){

                this.checkedItem.todoId = this.todoItem.id
                this.checkedItem.isChecked = this.todoItem.completed

                console.log(this.checkedItem)

                const { completed, success, message } = await Todo.complete(this.checkedItem);
            },


            async saveMemo()
            {
                
                if (this.editable) {
                    this.form.memoId = this.todoItem.memo.id;
                }

                this.form.todo_item_id = this.todoItem.id;

                const { created, success, message, errors } = await Todo.addMemo(this.form);

                if (success) {
                    this.form = {}
                    this.$refs['add-memo-modal'].hide()
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