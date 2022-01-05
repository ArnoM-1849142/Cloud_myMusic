using System.ServiceModel;

namespace Models
{
    [ServiceContract]
    public interface ICensorService{
        [OperationContract]
        public string censorSwearing(string text);

        [OperationContract]
        public string replaceSwearing(string text, string replacement);

        [OperationContract]
        public string replaceWordForWord(string text, string word, string newWord);
    }
}