import {
    IconCash,
    IconShield, IconUser,
    IconUsersGroup,
    IconUserShield,
} from '@tabler/icons-react'
import { z } from 'zod'
import {CheckCheck, PanelTopInactive} from "lucide-react";

export const statuses = [
    {
        value: 'active',
        label: 'Active',
        icon: CheckCheck,
    },
    {
        value: 'inactive',
        label: 'Inactive',
        icon: PanelTopInactive,
    },
    {
        value: 'invited',
        label: 'Invited',
        icon: PanelTopInactive,
    },
    {
        value: 'suspended',
        label: 'Suspended',
        icon: PanelTopInactive,
    }
]

// export const userStatuses = new Map<UserStatus, string>([
//     ['active', 'bg-teal-100/30 text-teal-900 dark:text-teal-200 border-teal-200'],
//     ['inactive', 'bg-neutral-300/40 border-neutral-300'],
//     ['invited', 'bg-sky-200/40 text-sky-900 dark:text-sky-100 border-sky-300'],
//     [
//         'suspended',
//         'bg-destructive/10 dark:bg-destructive/50 text-destructive dark:text-primary border-destructive/10',
//     ],
// ])

export const userTypes = [
    {
        label: 'Super Admin',
        value: 'super-admin',
        icon: IconShield,
    },
    {
        label: 'Admin',
        value: 'admin',
        icon: IconUserShield,
    },
    {
        label: 'Store Manager',
        value: 'store-manager',
        icon: IconCash,
    },
    {
        label: 'User',
        value: 'user',
        icon: IconUser,
    }
]

const userStatusSchema = z.union([
    z.literal('active'),
    z.literal('inactive'),
    z.literal('invited'),
    z.literal('suspended'),
])
export type UserStatus = z.infer<typeof userStatusSchema>

const userRoleSchema = z.union([
    z.literal('superadmin'),
    z.literal('admin'),
    z.literal('cashier'),
    z.literal('manager'),
])
