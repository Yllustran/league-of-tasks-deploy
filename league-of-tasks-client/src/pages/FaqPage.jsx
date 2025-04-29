import React from "react";
import { Accordion, Container } from "react-bootstrap";
import "./FaqPage.css";

const FaqPage = () => {
  return (
    <Container className="faq-page">
      <h1>Foire aux questions </h1>

      <Accordion defaultActiveKey="0" flush>
        <Accordion.Item eventKey="0">
          <Accordion.Header>Qu’est-ce que League of Tasks ?</Accordion.Header>
          <Accordion.Body>
            League of Tasks est une application web de productivité gamifiée. Elle vous permet de suivre vos tâches,
            gagner de l’XP, rejoindre des ligues et rester motivé à long terme.
          </Accordion.Body>
        </Accordion.Item>

        <Accordion.Item eventKey="1">
          <Accordion.Header>Comment créer un compte ?</Accordion.Header>
          <Accordion.Body>
            Il suffit de cliquer sur "Rejoindre" dans la barre de navigation, puis de remplir le formulaire d’inscription.
          </Accordion.Body>
        </Accordion.Item>

        <Accordion.Item eventKey="2">
          <Accordion.Header>Est-ce que c’est gratuit ?</Accordion.Header>
          <Accordion.Body>
            Oui ! League of Tasks est entièrement gratuit. Des fonctionnalités avancées pourront être proposées
            à l’avenir sous forme d’abonnement, mais le cœur du service restera accessible librement.
          </Accordion.Body>
        </Accordion.Item>

        <Accordion.Item eventKey="3">
          <Accordion.Header>Que deviennent mes données ?</Accordion.Header>
          <Accordion.Body>
            Tes données sont protégées selon le RGPD. Tu peux à tout moment les modifier ou demander leur suppression
            en nous contactant via la page dédiée.
          </Accordion.Body>
        </Accordion.Item>

        <Accordion.Item eventKey="4">
          <Accordion.Header>Comment rejoindre une ligue ?</Accordion.Header>
          <Accordion.Body>
            Une fois inscrit, tu pourras créer ou rejoindre une ligue dans la section "Mes tâches". 
            Cela te permet de collaborer avec d'autres utilisateurs et débloquer des bonus.
          </Accordion.Body>
        </Accordion.Item>
      </Accordion>
    </Container>
  );
};

export default FaqPage;
