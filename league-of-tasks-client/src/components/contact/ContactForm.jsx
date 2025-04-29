import React, { useState } from "react";
import { Form, Button, Alert } from "react-bootstrap";
import useContactForm from "../../hooks/useContactForm";
import './ContactForm.css'

const ContactForm = () => {
    const { loading, error, success, setSuccess, sendContactForm } = useContactForm();
    const [formData, setFormData] = useState({
        contact_email: "",
        contact_subject: "",
        contact_message: ""
    });

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        await sendContactForm(formData);

        // Reset field when the message is sent
        setFormData({ contact_email: "", contact_subject: "", contact_message: "" });
    };

    return (
        <div className="contact-container">
            <h2 className="text-center">Contactez-nous</h2>
            {error && <Alert variant="danger">{error}</Alert>}
            {success && (
                <Alert variant="success" onClose={() => setSuccess(null)} dismissible>
                    {success}
                </Alert>
            )}
            <Form onSubmit={handleSubmit}>
                <Form.Group className="mb-3">
                    <Form.Control
                        type="email"
                        name="contact_email"
                        placeholder="Email"
                        value={formData.contact_email}
                        onChange={handleChange}
                        required
                    />
                </Form.Group>

                <Form.Group className="mb-3">
                    <Form.Control
                        type="text"
                        name="contact_subject"
                        placeholder="Sujets"
                        value={formData.contact_subject}
                        onChange={handleChange}
                        required
                    />
                </Form.Group>

                <Form.Group className="mb-3">
                    <Form.Control
                        as="textarea"
                        rows={4}
                        name="contact_message"
                        placeholder="Mon message"
                        value={formData.contact_message}
                        onChange={handleChange}
                        required
                    />
                </Form.Group>

                <Button type="submit"  className="w-100 contact-btn" disabled={loading}>
                    {loading ? "Envoi..." : "Envoyer mon message"}
                </Button>
            </Form>
        </div>
    );
};

export default ContactForm;
