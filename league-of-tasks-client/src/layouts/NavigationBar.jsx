import React, { useState } from "react";
import { Container, Navbar, Nav } from "react-bootstrap";
import { Link } from "react-router-dom";
import Logo from "../components/navbar/Logo";
import NavLink from "../components/navbar/NavLink";
import "./NavigationBar.css";
import HamburgerButton from "../components/navbar/HamburgerButton";

const NavigationBar = () => {
  const [expanded, setExpanded] = useState(false);

  return (
    <Navbar expand="lg" expanded={expanded} className="py-3">
      <Container>
        {/* Logo */}
        <Navbar.Brand as={Link} to="/">
          <Logo />
        </Navbar.Brand>

        {/* Show burger only on mobile*/}
        <div className="d-lg-none">
          <HamburgerButton expanded={expanded} setExpanded={setExpanded} />
        </div>

        {/* Navigation Links */}
        <Navbar.Collapse id="menu-mobile" className={expanded ? "show" : ""}>
          <Nav className="ms-auto">
            <NavLink />
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
};

export default NavigationBar;
