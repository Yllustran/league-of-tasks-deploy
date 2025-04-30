const axios = require('axios');
const { expect } = require('@jest/globals');

const Axios = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
});

const user = {};

describe('API - Utilisateur simple', () => {
  beforeAll(async () => {
    await login(user, {
      email: 'user1@user.com',
      password: 'password123'
    });
  });

  // ------------------------------------------------------------------------------
  // Get Interests 
  // ------------------------------------------------------------------------------
  test('GET /interests - should return list of interests', async () => {
    const res = await Axios.get('/interests');
    expect(res.status).toBe(200);
    expect(Array.isArray(res.data)).toBe(true);
  });

  // ------------------------------------------------------------------------------
  // GET User Profile
  // ------------------------------------------------------------------------------
  test('GET /profile - should return user profile', async () => {
    const res = await Axios.get('/profile');
    expect(res.status).toBe(200);
    expect(res.data.email).toBe('user1@user.com');
  });

  // ------------------------------------------------------------------------------
  // POST Interests (Warning)
  // ------------------------------------------------------------------------------
  test('POST /interests - should be forbidden for regular user', async () => {
    const interest = {
      interest_name: 'Tentative utilisateur',
      interest_description: 'Ne devrait pas être autorisé'
    };

    const res = await Axios.post('/interests', interest, {
      validateStatus: () => true //
    });

    expect(res.status).toBe(403);
    expect(res.data.error).toBe('Unauthorized. Admin access required.');
  });
});

// ------------------------------------------------------------------------------
// UTILS
// ------------------------------------------------------------------------------
async function login(user, credentials) {
  const query = `?email=${encodeURIComponent(credentials.email)}&password=${encodeURIComponent(credentials.password)}`;
  const res = await Axios.post('/login' + query);

  const token = res.data.token;
  Axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
  user.token = token;
}
