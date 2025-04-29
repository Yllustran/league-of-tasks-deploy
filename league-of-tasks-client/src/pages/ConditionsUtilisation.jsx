import React from "react";
import { Container } from "react-bootstrap";
import "./Legal.css";

const ConditionsUtilisation = () => {
  return (
    <Container className="legal-page">
      <h1>Conditions Générales d’Utilisation</h1>

      <section>
        <h2>1. Objet</h2>
        <p>
          Les présentes conditions définissent les modalités d’utilisation du site League of Tasks.
          En accédant au site, vous acceptez sans réserve les présentes CGU.
        </p>
      </section>

      <section>
        <h2>2. Accès au service</h2>
        <p>
          Le site est accessible gratuitement. Certaines fonctionnalités nécessitent la création d’un compte.
        </p>
      </section>

      <section>
        <h2>3. Propriété intellectuelle</h2>
        <p>
          Tous les éléments du site (textes, images, code, etc.) sont protégés par le droit d’auteur.
          Toute reproduction est interdite sans autorisation.
        </p>
      </section>

      <section>
        <h2>4. Données personnelles</h2>
        <p>
          League of Tasks respecte la législation en vigueur (RGPD). Les données collectées sont sécurisées
          et utilisées uniquement dans le cadre des services proposés. Vous disposez d’un droit d’accès,
          de rectification et de suppression en contactant : contact@leagueoftasks.com
        </p>
      </section>

      <section>
        <h2>5. Responsabilité</h2>
        <p>
          League of Tasks ne peut être tenu responsable en cas de mauvaise utilisation du site ou d’interruption de service.
        </p>
      </section>

      <section>
        <h2>6. Droit applicable</h2>
        <p>
          Les présentes conditions sont régies par le droit français. Tout litige sera porté devant les juridictions compétentes.
        </p>
      </section>
    </Container>
  );
};

export default ConditionsUtilisation;
