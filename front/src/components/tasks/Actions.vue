<template>
    <div>
        <!-- <b-icon icon="three-dots" class="three-dots" font-scale="2" @click="showDropDown"></b-icon> -->
        <b-dropdown variant="link" toggle-class="text-decoration-none pr-5 drop-down" no-caret size="sm" right class="drop-down-div">
            <template #button-content>
                <b-icon icon="three-dots" class="float-right three-dots" font-scale="2"></b-icon>
            </template>
            <b-dropdown-item @click="pinItem">
                <i class="fa fa-thumb-tack"> </i> 
                Pin on the top
            </b-dropdown-item>
            <b-dropdown-item @click="triggerAddMemo">Add a memo</b-dropdown-item>
            <b-dropdown-item-button @click="deleteItem">Delete</b-dropdown-item-button>
        </b-dropdown>
    </div>
</template>
<script>
import Todo from '@/services/todo';
export default {
    name: 'ActionsButton',
    props: ["data"],
    computed: {
        todoItemId() {
            return this.data ? this.data : {};
        },        
    },

    methods: {
        async deleteItem(){
            const { deleted, success, message } = await Todo.delete(this.todoItemId);

            if (success) {
                this.$emit("deleteItem", this.todoItemId);
            }
        },

        pinItem(){
        },
        
        triggerAddMemo() {
            this.$emit("triggerAddMemo", this.todoItemId);
            // this.$refs["add-memo-modal"].show();
        },
    }
}
</script>

<style lang="scss" scoped>
    .three-dots{
        width: 18px;
        color: #ccd7e2;
    }
    
    .dropdown-menu{
        min-width: 0 !important;
        /* Style for "Union 4" */
        width: 137px;
        height: 100px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        background-color: #484f59 !important;

    }
</style>
