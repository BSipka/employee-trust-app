import { createBrowserRouter } from "react-router-dom";
import DefaultLayout from "./layouts/DefaultLayout";
import HomePage from "./pages/Home";
import ErrorPage from "./pages/Error";
import AdminLayout from "./layouts/AdminLayout";
import UsersPage, { loadUsers } from "./pages/Admin/Users/Users";
import AddUserPage from "./pages/Admin/Users/AddUser";
import AuthenticationPage, {
    action as authAction,
} from "./pages/Authentication";
import { action as logoutAction } from "./pages/Logout";
import { authUserLoader } from "./util/auth";
import ApplicantLayout from "./layouts/ApplicantLayout";
import JobsPage from "./pages/Applicant/Jobs";

export const router = createBrowserRouter([
    {
        path: "/",
        element: <DefaultLayout />,
        id: "default",
        errorElement: <ErrorPage />,
        children: [
            {
                path: "/",
                element: <HomePage />,
                index: true,
            },

            {
                path: "auth",
                element: <AuthenticationPage />,
                action: authAction,
            },
            {
                path: "logout",
                action: logoutAction,
            },
        ],
    },
    {
        path: "applicant",
        element: <ApplicantLayout />,
        id: "applicant",
        loader: authUserLoader,
        errorElement: <ErrorPage />,
        children: [
            {
                index: true,
                element: <JobsPage />,
            },
        ],
    },
    {
        path: "admin",
        element: <AdminLayout />,
        id: "admin",
        loader: authUserLoader,
        errorElement: <ErrorPage />,
        children: [
            {
                index: true,
                element: <UsersPage />,
                loader: loadUsers,
            },
            {
                path: "users/new",
                element: <AddUserPage />,
            },
        ],
    },
]);
