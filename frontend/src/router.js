import { createBrowserRouter } from "react-router-dom";
import DefaultLayout from "./layouts/DefaultLayout";
import HomePage from "./pages/Home";
import ErrorPage from "./pages/Error";
import AdminLayout, { loader as adminLoader } from "./layouts/AdminLayout";
import UsersPage, { loadUsers } from "./pages/Admin/Users/Users";
import AddUserPage from "./pages/Admin/Users/AddUser";
import AuthenticationPage, {
    action as authAction,
} from "./pages/Authentication";
import { action as logoutAction } from "./pages/Logout";
import ApplicantLayout, {
    loader as applicantLoader,
} from "./layouts/ApplicantLayout";
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
        loader: applicantLoader,
        errorElement: <ErrorPage />,
        children: [
            {
                index: true,
                element: <HomePage />,
            },
            {
                path: "jobs",
                element: <JobsPage />,
            },
        ],
    },
    {
        path: "admin",
        element: <AdminLayout />,
        id: "admin",
        loader: adminLoader,
        errorElement: <ErrorPage />,
        children: [
            {
                index: true,
                element: <HomePage />,
            },

            {
                path: "users",
                element: <UsersPage />,
                id: "users",
                loader: loadUsers,
            },
            {
                path: "users/new",
                element: <AddUserPage />,
            },
        ],
    },
]);
