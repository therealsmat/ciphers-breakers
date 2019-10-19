<template>
    <div class="w-full flex">
            <main class="w-1/2 pt-8 border-l border-r border-gray-200 bg-white px-8" style="min-height: 100vh">
                <label class="block">
                    <span class="text-gray-700">Cipher Text</span>
                    <textarea cols="30" rows="15" class="form-textarea block w-full text-xs" placeholder="Enter your cipher text here" v-model="cipher"></textarea>
                </label>
        
                <div class="mt-4">
                    <div class="flex flex-col mt-2 w-full justify-center">
                        <h4 class="mb-2 text-gray-700">Plain Text</h4>
                        <div class="bg-gray-100 text-gray-800 border h-auto rounded px-2 mt-2 lg:ml-6 text-xs" v-if="plainText">
                            <p class="break-words mb-1" >{{ plainText }}</p>
                        </div>
                    </div>
                </div>
            </main>
        
            <main class="w-1/2 pt-8 px-8">
                <h3 class="text-gray-800 border-b mb-2 font-bold">Obtain Decryption Key</h3>

                <div class="mt-2">
                    <h5 class="text-gray-700"> <span class="rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold text-white">1</span> Find repeating strings in the cipher text</h5>
                    <form action="" class="mt-2 lg:ml-6">
                        <input type="number" min="2" class="border w-1/6 text-xs py-1 px-4" v-model="length">
                        <a href="" class="underline text-indigo-700" @click.prevent="findRepeatingStrings()">Go!</a>
                    </form>
                    <div class="bg-white border h-auto rounded px-2 mt-2 lg:ml-6" v-if="repeatingStrings">
                        <span v-for="(string, index) in Object.keys(repeatingStrings)" :key="index">
                            <small :class="{'font-bold text-teal-600 text-lg': index == 0}">{{ string }}({{ repeatingStrings[string] }}), </small> 
                        </span>
                        ...
                    </div>
                </div>

                <div class="mt-8">
                    <h5 class="text-gray-700"> <span class="rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold text-white">2</span> Obtain the difference in positions & GCD of the chosen string.</h5>
                    <form action="" class="mt-2 lg:ml-6">
                        <input type="text" class="border w-1/4 text-xs py-1 px-4" placeholder="Enter string" v-model="needle">
                        <a href="" class="underline text-indigo-700" @click.prevent="obtainDifferenceInPositions()">Go!</a>
                    </form>
                    <div class="bg-white border h-auto rounded px-2 w-2/3 mt-2 lg:ml-6" v-if="differenceInPositions">
                        <h4 class="text-gray-700">Difference in positions: 
                            <span v-for="(difference, index) in differenceInPositions.difference" :key="index">
                                <small class="text-gray-900">{{ difference }}, </small>
                            </span>
                        </h4>
                        <h4 class="mt-2 text-gray-700">GCD: {{ differenceInPositions.gcd }}</h4>
                    </div>
                </div>

                <div class="mt-8">
                    <h5 class="text-gray-700"> <span class="rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold text-white">3</span> show the transposed text <a href="" class="underline text-indigo-700" @click.prevent="showTransposedText()">Go!</a></h5>
                    
                    <div class="bg-white border h-auto rounded px-2 mt-2 lg:ml-6" v-if="transposed">
                        <p class="break-words text-xs mb-1" style="font-size: 7px;" v-for="(string, index) in transposed" :key="index">{{ string }}</p>
                    </div>
                </div>

                <div class="mt-8">
                    <h5 class="text-gray-700"> <span class="rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold text-white">4</span> Grab the decryption key <a href="" class="underline text-indigo-700" @click.prevent="grabDecryptionKey()">Go!</a></h5>
                    
                    <div class="bg-white border h-auto rounded px-2 mt-2 lg:ml-6" v-if="decryptionKey">
                        <p class="break-words mb-1" >{{ decryptionKey }}</p>
                    </div>
                </div>

                <div class="mt-8">
                    <h5 class="text-gray-700"> <span class="rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold text-white">5</span> Display plain text </h5>
                    <form action="" class="mt-2 lg:ml-6">
                        <input type="text" value="3" min="2" class="border w-1/6 text-xs py-1 px-4" v-model="chosenDecryptionKey">
                        <a href="" class="underline text-indigo-700" @click.prevent="displayPlainText()">Go!</a>
                    </form>
                </div>
            </main>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cipher: '',
            repeatingStrings: null,
            needle: '',
            differenceInPositions: null,
            transposed: null,
            decryptionKey: null,
            chosenDecryptionKey: null,
            plainText: null,
            length: 3
        }
    },
    methods: {
        findRepeatingStrings() {
            axios.post('api/repeating-strings', {cipher: this.cipher, length: this.length}).then(res => {
                this.repeatingStrings = res.data;
            }).catch(err => {
                console.log(err);
            });
        },
        obtainDifferenceInPositions() {
            axios.post('api/difference-positions', {cipher: this.cipher, needle: this.needle}).then(res => {
                this.differenceInPositions = res.data;
            }).catch(err => {
                console.log(err);
            });
        },
        showTransposedText() {
            axios.post('api/transposed-text', {cipher: this.cipher, needle: this.needle}).then(res => {
                this.transposed = res.data;
            }).catch(err => {
                console.log(err);
            });
        },
        grabDecryptionKey() {
            axios.post('api/decryption-key', {cipher: this.cipher, needle: this.needle}).then(res => {
                this.decryptionKey = res.data;
            }).catch(err => {
                console.log(err);
            });
        },
        displayPlainText() {
            axios.post('api/plain-text', {cipher: this.cipher, needle: this.needle, key: this.chosenDecryptionKey}).then(res => {
                this.plainText = res.data;
            }).catch(err => {
                console.log(err);
            });
        }
    },
    watch: {
        decryptionKey() {
            return this.chosenDecryptionKey = this.decryptionKey;
        }
    }
}
</script>