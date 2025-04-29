import React from 'react';
import BlocOne from '../components/homepage/BlocOne';
import BlocTwo from '../components/homepage/BlocTwo';
import ContactForm from '../components/contact/ContactForm';

const HomePage = () => {
  return (
    <div>
      <BlocOne />
      <BlocTwo />
      <ContactForm />
    </div>
  );
};

export default HomePage;