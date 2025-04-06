import {
    ColumnDef, FilterFn,
} from "@tanstack/react-table"
import { Button } from "@/components/ui/button"
import { Checkbox } from "@/components/ui/checkbox"
import {BreadcrumbItem, User} from "@/types"
import { DataTableColumnHeader } from "@/components/shared/data-table-column-header"
import { DataTable } from "@/components/app-datatable"
import { cn } from "@/lib/utils"
import { Badge } from "@/components/ui/badge"
import { DataTableRowActions } from "@/components/datatables/data-table-row-actions"
import UsersProvider, { useUsers } from "./context/users-context";
import LongText from "@/components/long-text";
import { userTypes } from "./data/userdata";
import { CirclePlus, Import } from "lucide-react";
import { TasksDialogs } from "./components/user-dialogs";
import DataTableProvider, { useDataTable } from "@/components/datatables/datatable-context";
import { DataTableDialogs } from "@/components/datatables/data-table-dialogs";
import AuthLayout from "@/layouts/auth-layout";
import {Head} from "@inertiajs/react";
import {PlaceholderPattern} from "@/components/ui/placeholder-pattern";
import AppLayout from "@/layouts/app-layout";

// Custom filter function for multi-column searching
const multiColumnFilterFn: FilterFn<User> = (row, columnId, filterValue) => {
    const searchableRowContent = `${row.original.first_name} ${row.original.last_name} ${row.original.email} ${row.original.phone}`;
    return searchableRowContent.toLowerCase().includes(filterValue.toLowerCase());
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];

export default function Index(
    { users }: { users: User[] }
) {

    return (
        <AppLayout breadcrumbs={breadcrumbs} title={'Users'} description={'Manage users in your organization'}>
            <Head title="Users" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <UsersProvider>
                    <DataTableProvider<User>>
                        <IndexPage users={users} />
                        <DataTableDialogs />
                    </DataTableProvider>
                </UsersProvider>
            </div>
        </AppLayout>
    )
}

export function IndexPage(
    { users }: { users: User[] }
) {
    const { setCurrentRow, setOpen } = useDataTable()
    const columns: ColumnDef<User>[] = [
        {
            id: 'select',
            header: ({ table }) => (
                <Checkbox
                    checked={
                        table.getIsAllPageRowsSelected() ||
                        (table.getIsSomePageRowsSelected() && 'indeterminate')
                    }
                    onCheckedChange={(value) => table.toggleAllPageRowsSelected(!!value)}
                    aria-label='Select all'
                    className='translate-y-[2px]'
                />
            ),
            meta: {
                className: cn(
                    'sticky md:table-cell left-0 z-10 rounded-tl',
                    'bg-background transition-colors duration-200 group-hover/row:bg-muted group-data-[state=selected]/row:bg-muted'
                ),
            },
            cell: ({ row }) => (
                <Checkbox
                    checked={row.getIsSelected()}
                    onCheckedChange={(value) => row.toggleSelected(!!value)}
                    aria-label='Select row'
                    className='translate-y-[2px]'
                />
            ),
            enableSorting: false,
            enableHiding: false,
        },
        {
            id: 'fullName',
            accessorKey: 'fullName',
            header: ({ column }) => (
                <DataTableColumnHeader column={column} title='Name' />
            ),
            cell: ({ row }) => {
                const name = row.original.name;
                const fullName = `${name}`
                return <LongText className='max-w-36'>{fullName}</LongText>
            },
            meta: { className: 'w-36' },
            filterFn: multiColumnFilterFn
        },
        {
            accessorKey: 'email',
            header: ({ column }) => (
                <DataTableColumnHeader column={column} title='Email' />
            ),
            cell: ({ row }) => (
                <div className='w-fit text-nowrap'>{row.getValue('email')}</div>
            ),
        },
        {
            accessorKey: 'phoneNumber',
            header: ({ column }) => (
                <DataTableColumnHeader column={column} title='Phone Number' />
            ),
            cell: ({ row }) => {
                const phoneNo = row.original.meta['phone_no'];
                console.log(row.original)
                return (
                    <div>{phoneNo ?? "N/A"}</div>
                )
            },
            enableSorting: false,
        },
        {
            accessorKey: 'status',
            header: ({ column }) => (
                <DataTableColumnHeader column={column} title='Status' />
            ),
            cell: ({ row }) => {
                const status = row.original.is_active ? 'active' : 'inactive'

                return (
                    <div className='flex space-x-2'>
                        <Badge variant='outline' className={cn('capitalize')}>
                            {status}
                        </Badge>
                    </div>
                )
            },
            filterFn: (row, id, value) => {
                return value.includes(row.getValue(id))
            },
            enableHiding: false,
            enableSorting: false,
        },
        {
            accessorKey: 'role',
            header: ({ column }) => (
                <DataTableColumnHeader column={column} title='Role' />
            ),
            cell: ({ row }) => {
                const role = row.original.role
                const userType = userTypes.find(({ value }) => value === role)

                if (!userType) {
                    return null
                }

                return (
                    <div className='flex gap-x-2 items-center'>
                        {userType.icon && (
                            <userType.icon size={16} className='text-muted-foreground' />
                        )}
                        <span className='capitalize text-sm'>{row.getValue('role')}</span>
                    </div>
                )
            },
            filterFn: (row, id, value) => {
                return value.includes(row.getValue(id))
            },
            enableSorting: false,
            enableHiding: false,
        },
        {
            id: 'actions',
            cell: ({ row }) => {
                return DataTableRowActions({
                    row, onDelete: (id) => {
                        setCurrentRow(1)
                        setOpen('delete')
                    }, onEdit: (id) => console.log('edit', id)
                })
            },
        },
    ]

    return (
        <>
            <div className='mb-2 flex items-center justify-between space-y-2 flex-wrap gap-x-4'>
                <div>
                    <h2 className='text-2xl font-bold tracking-tight'>Users</h2>
                    <p className='text-muted-foreground'>
                        Manage users in your organization
                    </p>
                </div>
                <div className='flex gap-2'>
                    <Button
                        variant='outline'
                        className='space-x-1'
                    // onClick={() => setOpen('import')}
                    >
                        <span>Import</span> <Import />
                    </Button>
                    <Button className='space-x-1'
                    // onClick={() => setOpen('add')}
                    >
                        <span>Create</span> <CirclePlus />
                    </Button>
                </div>
            </div>

            <DataTable columns={columns} data={users} />
        </>
    )
}

