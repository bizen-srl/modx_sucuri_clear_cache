# SucuriClearCache for MODX Revolution

> **Version:** 1.0  
> **Author:** Manuel Barbiero - [Bizen Srl](https://www.bizen.it)  
> **Bugs and Requests:** [SucuriClearCache Issues](https://github.com/bizen-srl/SucuriClearCache/issues)

## Documentation
A MODX Revolution plugin that clears Sucuri cache automatically.  
- Clears Sucuri cache on every context on the "Clear Cache" event  
- Clears Sucuri cache on single files on the "File Update" event  

### Install
- Simply download through Package Management, and install.

### SucuriClearCache is a MODX Revolution plugin that can be used to clear Sucuri cache automatically for every context on "Clear Cache" event or for a single file on "File Update".
=======
### Setup
- Go to System Settings
- Set your API Key on `sucuri.api_key` and API Secret `sucuri.api_secret`.

## Multiple domains
If contexts are configured on different domains and/or use different Sucuri accounts a new set of `sucuri.api_key` and `sucuri.api_secret` must be added to each **Context Settings**.

## License
Code and documentation are released under the [MIT License](https://opensource.org/licenses/MIT).
