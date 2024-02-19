import React from "react";

export default function User({ user }) {
    return (
        <tr>
            <td>{user.first_name}</td>
        </tr>
    );
}
