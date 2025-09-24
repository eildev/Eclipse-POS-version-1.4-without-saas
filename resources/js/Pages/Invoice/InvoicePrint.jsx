import { useEffect } from "react";
import { router, usePage } from "@inertiajs/react";
import Invoice from "../../components/Invoice";

const InvoicePrint = () => {
    const { props } = usePage();
    const { returnUrl } = props;

    useEffect(() => {
        // Automatically trigger print on page load
        window.print();

        // FallBack Timer: print dialog close after 1 second redirect to the previous page
        const redirectTimer = setTimeout(() => {
            const redirectTo = returnUrl || "/sale-page";
            console.log("Redirecting to:", redirectTo);
            router.visit(redirectTo, { replace: true });
        }, 100);

        // onafterprint Event: If Browser supports it
        const handleAfterPrint = () => {
            clearTimeout(redirectTimer); // timer Cleanup
            const redirectTo = returnUrl || "/sale-page";
            console.log("After print, redirecting to:", redirectTo);
            router.visit(redirectTo, { replace: true });
        };

        window.onafterprint = handleAfterPrint;

        // Cleanup
        return () => {
            window.onafterprint = null;
            clearTimeout(redirectTimer);
        };
    }, [returnUrl]);

    return <Invoice />;
};

export default InvoicePrint;
