"use strict";
var medicament_show_1 = require('./controllers/medicament-show');
function router() {
    return [
        {
            prefix: 'management',
            actions: {
                'medicament.show': medicament_show_1.MedicamentShow
            }
        }
    ];
}
exports.router = router;

//# sourceMappingURL=routes.js.map
