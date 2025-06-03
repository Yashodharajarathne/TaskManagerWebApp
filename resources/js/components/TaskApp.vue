<template>
  <div class="task-app">
    <h2 class="heading">📝 Task Manager</h2>

    <form @submit.prevent="addTask" class="task-form">
      <input
        v-model="newTask"
        placeholder="Add a new task"
        required
        class="task-input"
      />
      <button type="submit" class="add-button">➕ Add</button>
    </form>

    <ul class="task-list">
      <li v-for="task in tasks" :key="task.id" class="task-item">
        <label class="checkbox-label">
          <input
            type="checkbox"
            :checked="task.is_completed"
            @change="toggle(task.id)"
          />
          <span
            :class="{
              'completed': task.is_completed,
              'incomplete': !task.is_completed
            }"
            class="task-title"
          >
            {{ task.title }}
          </span>
        </label>
        <button class="delete-button" @click="remove(task.id)">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </li>
    </ul>
  </div>
</template>

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
        })
        .catch(error => {
          console.error('Error fetching tasks:', error);
        });
    },

    addTask() {
      if (!this.newTask.trim()) return;

      axios.post('/api/tasks', { title: this.newTask })
        .then(() => {
          this.newTask = '';
          this.fetchTasks();
        })
        .catch(error => {
          console.error('Error adding task:', error);
        });
    },

    toggle(id) {
      axios.put(`/api/tasks/${id}`)
        .then(() => this.fetchTasks())
        .catch(error => {
          console.error('Error toggling task:', error);
        });
    },

    remove(id) {
      axios.delete(`/api/tasks/${id}`)
        .then(() => this.fetchTasks())
        .catch(error => {
          console.error('Error deleting task:', error);
        });
    }
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

body {
  background: linear-gradient(to bottom right, #e0f7fa, #f1f8e9);
  font-family: 'Fredoka One', sans-serif;
}

.task-app {
  max-width: 700px;
  margin: 3rem auto;
  padding: 2.5rem;
  background: rgba(255, 255, 255, 0.75);
  backdrop-filter: blur(10px);
  border-radius: 18px;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.heading {
  text-align: center;
  font-size: 2.2rem;
  margin-bottom: 2rem;
  color: #222;
}

.task-form {
  display: flex;
  gap: 0.7rem;
  margin-bottom: 2rem;
  justify-content: center;
}

.task-input {
  flex: 1;
  padding: 0.75rem 1rem;
  border: 1.5px solid #b2ebf2;
  border-radius: 12px;
  font-size: 1rem;
  transition: 0.3s ease;
  background: #f0faff;
}

.task-input:focus {
  border-color: #00acc1;
  outline: none;
  box-shadow: 0 0 0 3px #b2ebf230;
}

.add-button {
  background: #00bcd4;
  padding: 0.75rem 1.2rem;
  color: white;
  font-weight: bold;
  font-size: 1rem;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  transition: 0.2s;
}

.add-button:hover {
  background: #008ba3;
}

.task-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.task-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: white;
  border: 1px solid #e0f2f1;
  padding: 1rem 1.25rem;
  border-radius: 12px;
  margin-bottom: 0.75rem;
  transition: 0.3s ease;
  box-shadow: 0 3px 8px rgba(0, 188, 212, 0.05);
}

.task-item:hover {
  transform: scale(1.01);
  box-shadow: 0 4px 12px rgba(0, 188, 212, 0.1);
}

.checkbox-label {
  display: flex;
  align-items: center;
  gap: 0.7rem;
  flex-grow: 1;
}

.task-title {
  font-size: 1.1rem;
  transition: 0.2s;
}

.completed {
  color: #388e3c;
  text-decoration: line-through;
}

.incomplete {
  color: #212121;
}

.delete-button {
  background: transparent;
  border: none;
  color: #ff1744;
  font-size: 1.4rem;
  cursor: pointer;
  transition: color 0.2s ease;
}

.delete-button:hover {
  color: #d50000;
}
</style>
