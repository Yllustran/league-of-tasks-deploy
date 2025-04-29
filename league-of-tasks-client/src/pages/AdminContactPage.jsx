import { useEffect, useState } from "react";
import { Card,Button, Modal, Spinner, Alert, Container, Row,Col,} from "react-bootstrap";
import { getAllContacts, getContactById, deleteContact } from "../services/contactService";
import "./AdminContactPage.css"; 

const AdminContactPage = () => {
  const [contacts, setContacts] = useState([]);
  const [selectedContact, setSelectedContact] = useState(null);
  const [loading, setLoading] = useState(true);
  const [modalOpen, setModalOpen] = useState(false);
  const [error, setError] = useState("");

  // Load all messages when the component mounts.
  useEffect(() => {
    fetchContacts();
  }, []);

  const fetchContacts = async () => {
    try {
      setLoading(true);
      const data = await getAllContacts();
      setContacts(data);
    } catch (err) {
      setError("Erreur lors du chargement des messages.");
    } finally {
      setLoading(false);
    }
  };

  // Open modal with message details 
  const handleView = async (id) => {
    try {
      const contact = await getContactById(id);
      setSelectedContact(contact);
      setModalOpen(true);
    } catch (err) {
      setError("Erreur lors de la récupération du message.");
    }
  };

  // Delete a message
  const handleDelete = async (id) => {
    if (!window.confirm("Supprimer ce message ?")) return;

    try {
      await deleteContact(id);
      setContacts((prev) => prev.filter((c) => c.id !== id));
    } catch (err) {
      setError("Erreur lors de la suppression.");
    }
  };

  return (
    <Container className="mt-4">
      <h2 className="invoice-h2">Boîte de réception</h2>

      {error && <Alert variant="danger">{error}</Alert>}
      {loading ? (
        <Spinner animation="border" />
      ) : (
        <Row className="g-3">
          {contacts.map((contact) => (
            <Col key={contact.id} xs={12} sm={6} md={4} lg={3}>
              <Card className="contact-card">
                <Card.Body>
                  <Card.Title>{contact.contact_subject}</Card.Title>
                  <Card.Subtitle className="mb-2 text-muted">
                    {contact.contact_email}
                  </Card.Subtitle>
                  <Card.Subtitle className="mb-2 text-muted">
                    {new Intl.DateTimeFormat('fr-FR', {
                        dateStyle: 'short',
                        timeStyle: 'short'
                    }).format(new Date(contact.created_at))}
                    </Card.Subtitle>
                  <Card.Text>{contact.subject}</Card.Text>
                  <Button
                    variant="primary"
                    onClick={() => handleView(contact.id)}
                    className="me-2"
                  >
                    Voir
                  </Button>
                  <Button
                    variant="danger"
                    onClick={() => handleDelete(contact.id)}
                  >
                    Supprimer
                  </Button>
                </Card.Body>
              </Card>
            </Col>
          ))}
        </Row>
      )}

      {/* Modal for show message */}
      <Modal show={modalOpen} onHide={() => setModalOpen(false)}>
        <Modal.Header closeButton>
          <Modal.Title>Détail du message</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          {selectedContact ? (
            <>
              <p>
                <strong>Email :</strong> {selectedContact.contact_email}
              </p>
              <p>
                <strong>Sujet :</strong> {selectedContact.contact_subject}
              </p>
              <p>
                <strong>Message :</strong>
                <br />
                {selectedContact.contact_message}
              </p>
            </>
          ) : (
            <Spinner animation="border" />
          )}
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setModalOpen(false)}>
            Fermer
          </Button>
        </Modal.Footer>
      </Modal>
    </Container>
  );
};

export default AdminContactPage;
