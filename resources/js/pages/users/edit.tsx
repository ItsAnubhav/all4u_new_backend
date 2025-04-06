"use client"
import { toast } from "sonner"
import { useForm } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import * as z from "zod"
import { Button } from "@/components/ui/button"
import {
    Form,
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form"
import {
    Input
} from "@/components/ui/input"
import {
    Icon,
    SaveAll
} from "lucide-react"
import { BreadcrumbItem, User } from "@/types"
import {Head, router, usePage} from '@inertiajs/react'
import AppLayout from "@/layouts/app-layout";
import {cn} from "@/lib/utils";
import {useState} from "react";
import {Label} from "@/components/ui/label";

const formSchema = z.object({
    name: z.string(),
    email: z.string(),
    phone_no: z.string().optional(),
    is_active: z.boolean().optional(),
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];

export default function MyForm(
    { user }: { user: User }
) {

    const [isActive, setIsActive] = useState(user.is_active);

    // const toggleStatus = async (newStatus) => {
    //     setIsActive(newStatus);
    //
    //     // Optional: send to backend
    //     try {
    //         const response = await fetch(`/users/${user.id}/status`, {
    //             method: 'PUT',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'Accept': 'application/json',
    //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    //             },
    //             body: JSON.stringify({ is_active: newStatus }),
    //         });
    //
    //         if (!response.ok) throw new Error("Failed to update status");
    //     } catch (error) {
    //         console.error(error);
    //         // Optionally revert UI state
    //         setIsActive(!newStatus);
    //     }
    // };

    // const form = useForm<z.infer<typeof formSchema>>({
    //     resolver: zodResolver(formSchema),
    //     defaultValues: {
    //         "name": user.name,
    //         "email": user.email,
    //         "phone_no": "",
    //     },
    // })

    console.log("user", user);
    const form = useForm({
        resolver: zodResolver(formSchema),
        defaultValues: {
            "name": user.name,
            "email": user.email,
            "phone_no": user.meta['phone_no'] || "",
            "is_active": user.is_active,
        },
    })

    function onSubmit(values) {
        try {
            console.log(values);
            router.patch(`/users/${user.id}`, values)
            toast(
                <pre className="mt-2 w-[340px] rounded-md bg-slate-950 p-4">
                    <code className="text-white">{JSON.stringify(values, null, 2)}</code>
                </pre>
            );
        } catch (error) {
            console.error("Form submission error", error);
            toast.error("Failed to submit the form. Please try again.");
        }
    }

    const handleCancel = () => {
        history.back(); // Navigate back to the previous page
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={"Edit User"} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Form {...form}>
                    <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-5 max-w-3xl py-10">
                        <FormField
                            control={form.control}
                            name="name"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Name</FormLabel>
                                    <FormControl>
                                        <Input
                                            placeholder="John"
                                            type=""
                                            {...field} />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        <FormField
                            control={form.control}
                            name="phone_no"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Phone No</FormLabel>
                                    <FormControl>
                                        <Input
                                            placeholder="9999999999"
                                            type="text"
                                            {...field} />
                                    </FormControl>

                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        <FormField
                            control={form.control}
                            name="email"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Email</FormLabel>
                                    <FormControl>
                                        <Input
                                            placeholder="johndoe@example.com"
                                            disabled
                                            type="email"
                                            {...field} />
                                    </FormControl>

                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                        <FormField
                            control={form.control}
                            name="is_active"
                            render={({ field }) => (
                            <Input
                                disabled
                                type="hidden"
                                value={isActive}
                                {...field} />
                        )}
                        />
                        <div className="items-top flex space-x-2">
                            <Label title="User Status"/>
                            <div className='inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800'>
                                <button
                                    key='active'
                                    onClick={() => setIsActive(true)}
                                    className={cn(
                                        'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                                        isActive
                                            ? 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100'
                                            : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60',
                                    )}
                                >
                                    <span className="ml-1.5 text-sm">Active</span>
                                </button>
                                <button
                                    key='inactive'
                                    onClick={() => setIsActive(false)}
                                    className={cn(
                                        'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                                        isActive
                                            ? 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60'
                                            : 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100'
                                    )}
                                >
                                    <span className="ml-1.5 text-sm">InActive</span>
                                </button>
                            </div>
                        </div>

                        <div className='flex gap-2'>
                            <Button variant="outline" onClick={handleCancel}>Cancel</Button>
                            <Button className='space-x-1' type="submit">
                                <SaveAll /> Submit
                            </Button>
                        </div>
                    </form>
                </Form>
            </div>
        </AppLayout>
    )
}


