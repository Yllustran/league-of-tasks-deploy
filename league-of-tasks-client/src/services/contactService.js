import api from "./apiService";

// Get ALL contact message
export const getAllContacts = async () => {
  const response = await api.get("/contacts");
  return response.data;
};

// Get a contact message by ID
export const getContactById = async (id) => {
  const response = await api.get(`/contacts/${id}`);
  return response.data;
};

// Delete a contact message
export const deleteContact = async (id) => {
  const response = await api.delete(`/contacts/${id}`);
  return response.data;
};
