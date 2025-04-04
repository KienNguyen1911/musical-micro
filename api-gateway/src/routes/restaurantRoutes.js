const express = require('express');
const router = express.Router();
const auth = require('../middlewares/auth');
const axios = require('axios');

const RESTAURANT_SERVICE_URL = process.env.RESTAURANT_SERVICE_URL || 'http://restaurant-service:8000';

// Get all restaurants
router.get('/', async (req, res) => {
  try {
    const response = await axios.get(`${RESTAURANT_SERVICE_URL}/api/restaurants`);
    res.json(response.data);
  } catch (error) {
    res.status(500).json({
      status: 'error',
      message: 'Failed to fetch restaurants'
    });
  }
});

// Get restaurant by ID
router.get('/:id', async (req, res) => {
  try {
    const response = await axios.get(`${RESTAURANT_SERVICE_URL}/api/restaurants/${req.params.id}`);
    res.json(response.data);
  } catch (error) {
    res.status(500).json({
      status: 'error',
      message: 'Failed to fetch restaurant'
    });
  }
});

// Create restaurant (protected route)
router.post('/', auth, async (req, res) => {
  try {
    const response = await axios.post(`${RESTAURANT_SERVICE_URL}/api/restaurants`, req.body);
    res.status(201).json(response.data);
  } catch (error) {
    res.status(500).json({
      status: 'error',
      message: 'Failed to create restaurant'
    });
  }
});

// Update restaurant (protected route)
router.put('/:id', auth, async (req, res) => {
  try {
    const response = await axios.put(`${RESTAURANT_SERVICE_URL}/api/restaurants/${req.params.id}`, req.body);
    res.json(response.data);
  } catch (error) {
    res.status(500).json({
      status: 'error',
      message: 'Failed to update restaurant'
    });
  }
});

// Delete restaurant (protected route)
router.delete('/:id', auth, async (req, res) => {
  try {
    await axios.delete(`${RESTAURANT_SERVICE_URL}/api/restaurants/${req.params.id}`);
    res.status(204).send();
  } catch (error) {
    res.status(500).json({
      status: 'error',
      message: 'Failed to delete restaurant'
    });
  }
});

module.exports = router; 