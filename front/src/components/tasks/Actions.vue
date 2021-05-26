<template>
    <div class="">
        <b-dropdown  variant="link" toggle-class="text-decoration-none pr-5 drop-down" no-caret size="sm" right class="drop-down-div">
            <template #button-content>
                <b-icon icon="three-dots" class="float-right three-dots" font-scale="2"></b-icon>
            </template>
            <b-dropdown-item-button v-if="todoItem.pinned" @click="pinItem">
                <span class="mr-5"><i class="fa fa-thumb-tack pinned"> </i></span>
                Unpin from top
            </b-dropdown-item-button>

            <b-dropdown-item-button v-else @click="pinItem">
                <span class="mr-5"><i class="fa fa-thumb-tack unpin"> </i></span>
                Pin on the top
            </b-dropdown-item-button>

            <b-dropdown-item-button v-if="todoItem.memo" @click="triggerAddMemo(true)">
                <span class="mr-5"><i class="fa fa-file"> </i></span>
                Edit memo
            </b-dropdown-item-button>

            <b-dropdown-item-button v-else @click="triggerAddMemo(false)">
                <span class="mr-5"><i class="fa fa-file"> </i></span>
                Add a memo
            </b-dropdown-item-button>

            <b-dropdown-item-button @click="deleteItem(todoItem.id)">
                <span class="mr-5"><i class="fa fa-trash"> </i></span>
                Delete
            </b-dropdown-item-button>
        </b-dropdown>
    </div>
</template>
<script>
import Todo from '@/services/todo';
export default {
    name: 'ActionsButton',
    props: ["data"],
    computed: {
        todoItem() {
            return this.data ? this.data : {};
        },        
    },

    methods: {
        async deleteItem(todoId){
            const { deleted, success, message } = await Todo.delete(todoId);

            console.log(message)
            if (success) {
                this.$emit("deleteItem", this.todoItem.main_key);
            }
        },

        async pinItem(status){
            const { deleted, success, message } = await Todo.delete(todoId);

            if (success) {
                this.$emit("deleteItem", this.todoItem.main_key);
            }
        },
        
        triggerAddMemo(editable) {
            this.$emit("triggerAddMemo", editable);
        },
    }
}
</script>

<style lang="scss">
    .three-dots{
        width: 18px;
        color: #ccd7e2;
    }
    
    .dropdown.show {
        min-width: 0 !important;
        /* Style for "Union 4" */
        width: 137px;
        // height: 100px;
        color: #ccd7e2;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        background-color: #484f59;
    }

    #dropdownMenuButton__BV_toggle_ {
        width: 100%;
    }
</style>
