const axios = require('axios');
const { expect } = require('@jest/globals');

const Axios = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
});

const user = {};
let createdTask = null;
let createdInterest = null;

// ==============================================================================
// AUTHENTICATION ADMIN
// ==============================================================================
beforeAll(async () => {
  await login(user, {
    email: 'admin@admin.com',
    password: 'password123'
  });
});

// ==============================================================================
// TASKS - CRUD
// ==============================================================================
describe('API - Tasks', () => {
  test('GET /tasks - should return a list of tasks', async () => {
    const res = await Axios.get('/tasks');
    expect(res.status).toBe(200);
    expect(Array.isArray(res.data)).toBe(true);
  });

  test('POST /tasks - should create a new task', async () => {
    const taskData = {
      task_name: 'Test Task',
      mobility_req: 1,
      vision_req: 0,
      difficulty: 'easy',
      reward_xp: 10,
      reward_gold: 20,
      interest_id: 1
    };

    const res = await Axios.post('/tasks', taskData);
    expect(res.status).toBe(201);
    expect(res.data.task_name).toBe(taskData.task_name);

    createdTask = res.data;
  });

  test('PUT /tasks/:id - should update the created task', async () => {
    const updateData = {
      task_name: 'Updated Task Name',
      mobility_req: 0,
      vision_req: 1,
      difficulty: 'medium',
      reward_xp: 30,
      reward_gold: 50,
      interest_id: 1,
      _method: 'PUT'
    };

    const res = await Axios.post(`/tasks/${createdTask.id}`, updateData);
    expect(res.status).toBe(200);
    expect(res.data.task_name).toBe(updateData.task_name);
  });

  test('DELETE /tasks/:id - should delete the created task', async () => {
    const res = await Axios.delete(`/tasks/${createdTask.id}`);
    expect(res.status).toBe(200);

    const allTasks = await Axios.get('/tasks');
    const exists = allTasks.data.find(t => t.id === createdTask.id);
    expect(exists).toBeUndefined();
  });
});

// ==============================================================================
// INTERESTS - CRUD
// ==============================================================================
describe('API - Interests', () => {
  test('GET /interests - should return a list of interests', async () => {
    const res = await Axios.get('/interests');
    expect(res.status).toBe(200);
    expect(Array.isArray(res.data)).toBe(true);
  });

  test('POST /interests - should create a new interest', async () => {
    const data = {
      interest_name: 'Test Interest',
      interest_description: 'Description pour les tests'
    };

    const res = await Axios.post('/interests', data);
    expect(res.status).toBe(201);
    expect(res.data.interest_name).toBe(data.interest_name);
    expect(res.data.interest_description).toBe(data.interest_description);

    createdInterest = res.data;
  });

  test('PUT /interests/:id - should update the interest', async () => {
    const update = {
      interest_name: 'Updated Interest',
      interest_description: 'Nouvelle description',
      _method: 'PUT'
    };

    const res = await Axios.post(`/interests/${createdInterest.id}`, update);
    expect(res.status).toBe(200);
    expect(res.data.interest_name).toBe(update.interest_name);
    expect(res.data.interest_description).toBe(update.interest_description);
  });

  test('DELETE /interests/:id - should delete the interest', async () => {
    const res = await Axios.delete(`/interests/${createdInterest.id}`);
    expect(res.status).toBe(200);

    const all = await Axios.get('/interests');
    const exists = all.data.find(i => i.id === createdInterest.id);
    expect(exists).toBeUndefined();
  });
});

// ==============================================================================
// UTILS
// ==============================================================================
async function login(user, credentials) {
  const query = `?email=${encodeURIComponent(credentials.email)}&password=${encodeURIComponent(credentials.password)}`;
  const res = await Axios.post('/login' + query);

  const token = res.data.token;
  Axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

  user.token = token;
}
