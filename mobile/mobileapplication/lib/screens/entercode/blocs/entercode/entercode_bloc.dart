import 'package:equatable/equatable.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/models/checkidroom/entercode_response.dart';
import 'package:mobileapplication/responsitory/repository.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_event.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_state.dart';
import 'package:socket_io_client/socket_io_client.dart' as IO;

class EnterCodeBloc extends Bloc<EnterCodeEvent, EnterCodeState> {
  final Repository repository;
  EnterCodeBloc({required this.repository}) : super(const EnterCodeState());

  @override
  Stream<EnterCodeState> mapEventToState(EnterCodeEvent event) async* {
    if (event is EnterCodeSumitted) {
      yield EnterCodeStateLoading();
      try {
        final EnterCodeResponse? checkIdRoomResponse =
            await repository.checkidRoom(event.idroom);

        if (checkIdRoomResponse != null) {
          yield EnterCodeStateSuccess(checkIdRoomResponse);
        } else {
          yield EnterCodeStateFail();
        }
      } catch (e) {
        yield EnterCodeStateFail();
      }
    }
  }
}
