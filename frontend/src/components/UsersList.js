import React from "react";
import User from "./User";
import { useLoaderData } from "react-router-dom";

export default function UsersList() {
    const users = useLoaderData();

    return (
        <table>
            <thead>
                <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>Role</td>
                </tr>
            </thead>
            <tbody>
                {users.map((user) => {
                    return <User key={user.id} user={user} />;
                })}
            </tbody>
        </table>
    );
}
