import React from "react";
import { Container, Row, Col, Card, Button } from "react-bootstrap";
import { useNavigate } from "react-router-dom";
import ".//AdminDashboard.css";

const AdminDashboard = () => {
  const navigate = useNavigate();

  return (
    <Container className="admin-dashboard">
      <h1 className="text-center my-4">Admin Dashboard</h1>
      <p className="text-center">Bienvenue sur le panel Admin.</p>

      <Row className="g-4">
        {/* Contacts message  Section */}
        <Col xs={12} sm={6} md={4}>
          <Card className="dashboard-card">
            <Card.Body>
              <Card.Title>📩 Gestion des contacts</Card.Title>
              <Card.Text>Consulter et supprimer les messages des utilisateurs.</Card.Text>
              <Button variant="primary" onClick={() => navigate("/admin/contacts")}>
                Accéder
              </Button>
            </Card.Body>
          </Card>
        </Col>

        {/* Users Section */}
        <Col xs={12} sm={6} md={4}>
          <Card className="dashboard-card disabled-card">
            <Card.Body>
              <Card.Title>👥 Gestion des utilisateurs</Card.Title>
              <Card.Text>Bientôt disponible</Card.Text>
              <Button variant="secondary" disabled>
                À venir
              </Button>
            </Card.Body>
          </Card>
        </Col>

        {/* Roles Section */}
        <Col xs={12} sm={6} md={4}>
          <Card className="dashboard-card disabled-card">
            <Card.Body>
              <Card.Title>🔑 Gestion des rôles</Card.Title>
              <Card.Text>Bientôt disponible</Card.Text>
              <Button variant="secondary" disabled>
                À venir
              </Button>
            </Card.Body>
          </Card>
        </Col>

        {/* Tasks Section */}
        <Col xs={12} sm={6} md={4}>
          <Card className="dashboard-card disabled-card">
            <Card.Body>
              <Card.Title>✅ Gestion des tâches</Card.Title>
              <Card.Text>Bientôt disponible</Card.Text>
              <Button variant="secondary" disabled>
                À venir
              </Button>
            </Card.Body>
          </Card>
        </Col>

        {/* Interests Section */}
        <Col xs={12} sm={6} md={4}>
          <Card className="dashboard-card disabled-card">
            <Card.Body>
              <Card.Title>🎯 Gestion des Centres d'intérêts</Card.Title>
              <Card.Text>Bientôt disponible</Card.Text>
              <Button variant="secondary" disabled>
                À venir
              </Button>
            </Card.Body>
          </Card>
        </Col>
        {/* Leagues Section */}
        <Col xs={12} sm={6} md={4}>
          <Card className="dashboard-card disabled-card">
            <Card.Body>
              <Card.Title>🏆 Gestion des ligues</Card.Title>
              <Card.Text>Bientôt disponible</Card.Text>
              <Button variant="secondary" disabled>
                À venir
              </Button>
            </Card.Body>
          </Card>
        </Col>
        {/* Avatar Section */}
        <Col xs={12} sm={6} md={4}>
          <Card className="dashboard-card disabled-card">
            <Card.Body>
              <Card.Title>🖼️ Gestion des avatars</Card.Title>
              <Card.Text>Bientôt disponible</Card.Text>
              <Button variant="secondary" disabled>
                À venir
              </Button>
            </Card.Body>
          </Card>
        </Col>

        <Col xs={12} sm={6} md={4}>
          <Card className="dashboard-card disabled-card">
            <Card.Body>
              <Card.Title>📊 Statistiques</Card.Title>
              <Card.Text>Bientôt disponible</Card.Text>
              <Button variant="secondary" disabled>
                À venir
              </Button>
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
};

export default AdminDashboard;
