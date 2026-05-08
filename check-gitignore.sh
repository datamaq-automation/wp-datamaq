#!/bin/bash

# ==============================================================================
# DATA MAQ - REVISOR DE INFILTRADOS (V3: FIX FLAGS)
# ==============================================================================

echo -e "\n🔍 Buscando archivos trackeados que COINCIDEN con el .gitignore..."
echo "----------------------------------------------------------------"

# -c: cached (trackeados)
# -i: ignored
INFILTRATORS=$(git ls-files -ci --exclude-standard)

if [ -z "$INFILTRATORS" ]; then
    echo -e "✅ ¡Excelente! No hay archivos en GitHub que deberían estar ignorados."
else
    echo -e "⚠️  Se encontraron los siguientes archivos 'infiltrados':"
    echo "$INFILTRATORS" | sed 's/^/   -> /'
    
    echo -e "\n----------------------------------------------------------------"
    echo -e "💡 TIP: Estos archivos están en GitHub. Para quitarlos de la nube"
    echo -e "   SIN borrarlos de tu computadora, ejecutá:"
    echo -e "   git rm --cached <ruta-del-archivo>"
fi
echo ""
