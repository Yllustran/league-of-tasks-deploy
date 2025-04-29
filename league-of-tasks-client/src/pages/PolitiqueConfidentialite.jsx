import React from "react";
import { Container } from "react-bootstrap";
import "./Legal.css";

const PolitiqueConfidentialite = () => {
  return (
    <Container className="legal-page">
      <h1>Politique de confidentialité</h1>

      <section>
        <h2>1. Collecte des données</h2>
        <p>
          Nous collectons uniquement les données nécessaires au bon fonctionnement du service :
          création de compte, authentification, envoi de messages via le formulaire de contact, statistiques anonymes.
        </p>
      </section>

      <section>
        <h2>2. Utilisation des données</h2>
        <p>
          Vos données ne sont utilisées que pour :
          - vous identifier en tant qu'utilisateur,
          - personnaliser votre expérience,
          - répondre à vos messages,
          - améliorer le service.
        </p>
      </section>

      <section>
        <h2>3. Partage des données</h2>
        <p>
          Aucune de vos données n’est vendue ni partagée avec des tiers, sauf obligation légale.
        </p>
      </section>

      <section>
        <h2>4. Sécurité</h2>
        <p>
          Vos données sont stockées de manière sécurisée, avec des mesures techniques et organisationnelles adaptées.
        </p>
      </section>

      <section>
        <h2>5. Vos droits</h2>
        <p>
          Conformément au RGPD, vous pouvez accéder, rectifier ou supprimer vos données à tout moment
          en nous contactant à : <strong>contact@leagueoftasks.com</strong>
        </p>
      </section>

      <section>
        <h2>6. Cookies</h2>
        <p>
          Ce site peut utiliser des cookies pour améliorer l’expérience utilisateur. Vous pouvez configurer votre
          navigateur pour les refuser.
        </p>
      </section>

      <section>
        <h2>7. Contact</h2>
        <p>
          Pour toute question relative à vos données personnelles, contactez-nous à :
          <strong> contact@leagueoftasks.com</strong>
        </p>
      </section>
    </Container>
  );
};

export default PolitiqueConfidentialite;
