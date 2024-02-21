import React from "react";
import { NavLink } from "react-router-dom";
import classes from "./MainNavigation.module.css";

export default function AdminNavigation() {
    return (
        <header className={classes.header}>
            <nav>
                <ul className={classes.list}>
                    <li>
                        <NavLink
                            to="/admin/users"
                            className={({ isActive }) =>
                                isActive ? classes.active : undefined
                            }
                            end
                        >
                            Users
                        </NavLink>
                    </li>
                    {/* <li>
                        <NavLink
                            to="/login"
                            className={({ isActive }) =>
                                isActive ? classes.active : undefined
                            }
                        >
                            Login
                        </NavLink>
                    </li> */}
                </ul>
            </nav>
        </header>
    );
}
