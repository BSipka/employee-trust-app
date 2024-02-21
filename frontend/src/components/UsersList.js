import React from "react";
import User from "./User";

export default function UsersList({users}) {

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
                {users.length &&
                    users.map((user) => {
                        return <User key={user.id} user={user} />;
                    })}
            </tbody>
        </table>
    );
}


