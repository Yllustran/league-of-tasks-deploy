import React from "react";
import { Container, Row, Col } from "react-bootstrap";
import { Link } from "react-router-dom";
import Logo from "../navbar/Logo";
import "./Footer.css";

const Footer = () => {
  return (
    <footer className="footer">
      <Container>
        <Row className="footer-content">
          {/* Row 1 : Logo + description */}
          <Col xs={12} md={4} className="footer-col">
            <Logo />
            <p className="footer-text">
              League of Tasks est une application communautaire dédiée à la productivité gamifiée.
            </p>
          </Col>

          {/* Row  : navigation link */}
          <Col xs={6} md={4} className="footer-col">
            <h5>Navigation</h5>
            <ul className="footer-links">
              <li><Link to="/">Accueil</Link></li>
              <li><Link to="/about">C’est quoi LoT ?</Link></li>
              <li><Link to="/faq">FAQ</Link></li>
              <li><Link to="/contact">Contact</Link></li>
            </ul>
          </Col>

          {/* row 3 : law information */}
          <Col xs={6} md={4} className="footer-col">
            <h5>Informations</h5>
            <ul className="footer-links">
              <li><Link to="/conditions-utilisation">Conditions d’utilisation</Link></li>
              <li><Link to="/politique-confidentialite">Politique de confidentialité</Link></li>
              <li><Link to="/mentions-legales">Mentions légales</Link></li>
            </ul>
          </Col>
        </Row>

        {/* copyright */}
        <Row>
          <Col className="text-center mt-4">
            <p className="footer-copyright">
              © {new Date().getFullYear()} League of Tasks. Tous droits réservés.
            </p>
          </Col>
        </Row>
      </Container>
    </footer>
  );
};

export default Footer;
