## (Pre-order) Print Layouts Manager

Add a print layout manager (much like the existing mail templates editor) for creating and managing print layouts for orders.

Note that this is specifically for full color, inkjet printers! If you're looking for a way to print to kitchen thermal printers, use https://tastyigniter.com/marketplace/item/thoughtco-printer.

Intended use-cases include pre-printing a large amount of pre-orders for a day in a condensed format, or printing out customized invoices/receipts.

The Print Layout Manager tool is under the Design Tab. A single "Pre-Orders" layout is included to serve as an example of how to create a new printable layout. 

Each layout has it's own CSS element do they can be designed individually. Basic HTML/CSS knowledge is required to design and update new layouts. 


### Dev notes

This extension leverages the existing `MailManager` class in order to render templates. You can extend the available template variables by updating the `mailGetData()` in the PrintLayouts model class.  






