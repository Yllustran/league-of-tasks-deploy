import { BrowserRouter as Router, Routes, Route, useLocation } from "react-router-dom";
import { AuthProvider } from "./context/AuthContext";
import { UserProvider } from "./context/UserContext";
import NavigationBar from "./layouts/NavigationBar";
import LoginPage from "./pages/LoginPage";
import HomePage from "./pages/HomePage";
import RegisterPage from "./pages/RegisterPage";
import ProfilePage from "./pages/ProfilePage";
import UpdateProfilePage from "./pages/UpdateProfilePage";
import MyTaskPage from "./pages/MyTaskPage";
import AdminDashboard from "./pages/AdminDashboard";
import Unauthorized from "./pages/Unauthorized";
import NotFound from "./pages/NotFound";
import PrivateRoute from "./routes/PrivateRoute";
import AdminRoute from "./routes/AdminRoute";
import AdminContactPage from "./pages/AdminContactPage";
import Footer from "./components/footer/Footer";
import MentionsLegales from "./pages/MentionsLegales";
import ConditionsUtilisation from "./pages/ConditionsUtilisation";
import PolitiqueConfidentialite from "./pages/PolitiqueConfidentialite";
import FaqPage from "./pages/FaqPage";

const AppContent = () => {
  const location = useLocation();
  const showFooterOn = ["/", "/politique-confidentialite", "/mentions-legales", "/conditions-utilisation", "/faq"];
  const shouldShowFooter = showFooterOn.includes(location.pathname);

  return (
    <AuthProvider>
      <UserProvider>
        <NavigationBar />
        <Routes>
          <Route path="/" element={<HomePage />} />
          <Route path="/login" element={<LoginPage />} />
          <Route path="/register" element={<RegisterPage />} />
          <Route path="/faq" element={<FaqPage />} />

          {/* Footer */}
          <Route path="/politique-confidentialite" element={<PolitiqueConfidentialite />} />
          <Route path="/mentions-legales" element={<MentionsLegales />} />
          <Route path="/conditions-utilisation" element={<ConditionsUtilisation />} />

          {/* JWT Protected routes */}
          <Route element={<PrivateRoute />}>
            <Route path="/profile" element={<ProfilePage />} />
            <Route path="/profile/update" element={<UpdateProfilePage />} />
            <Route path="/mytasks" element={<MyTaskPage />} />
          </Route>

          {/* Admin routes */}
          <Route element={<AdminRoute />}>
            <Route path="/admin" element={<AdminDashboard />} />
            <Route path="/admin/contacts" element={<AdminContactPage />} />
          </Route>

          {/* Special pages */}
          <Route path="/unauthorized" element={<Unauthorized />} />
          <Route path="*" element={<NotFound />} />
        </Routes>

        {shouldShowFooter && <Footer />}
      </UserProvider>
    </AuthProvider>
  );
};

function App() {
  return (
    <Router>
      <AppContent />
    </Router>
  );
}

export default App;
