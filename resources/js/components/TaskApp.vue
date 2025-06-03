<template>
 <div class="task-app">
 <form @submit.prevent="addTask">
  <input v-model="newTask" placeholder="Add a new task" required/>
  <button type="submit">Add Task</button>
    </form>
    <ul>
        <li v-for="task in tasks" :key="task.id">
            <input type="checkbox"
            :checked="task.is_completed"
            @change="toggle(task.id)"
            />
            <span :style="{color: task.is_completed ? 'green' : 'red'}">
                {{ task.title }}
            </span>
            <button @click="remove(task.id)">Delete</button>
        </li>
    </ul>
    </div>
</template>

<style>
.task-app {
    max-width: 500px;
    margin: 2rem auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
}

input[type="text"] {
    width: 70%;
    padding: 0.5rem;
    margin-right:0.5rem;
}
button {
    padding: 0.5rem;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;

}li {
   list-style: none;
   margin-top: 0.5rem;
}

</style>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            tasks: [],
            newTask: ''
        };
    },
    mounted() {
        this.fetchTasks();
    },
    methods: {
        fetchTasks() {
            axios.get('/api/tasks')
                .then(res => {
                    this.tasks = res.data;
                });
        },

        addTask() {
            axios.post('/api/tasks', { title: this.newTask })
                .then(()=> {
                    this.newTask = '';
                    this.fetchTasks();
                });

        },

        toggle(id) {
                axios.put(`/api/tasks/${id}`)
                .then(() => this.fetchTasks());

        },

        remove(id) {
            axios.delete(`/api/tasks/${id}`)
                .then(() => this.fetchTasks());

        }
    }

};
</script>


